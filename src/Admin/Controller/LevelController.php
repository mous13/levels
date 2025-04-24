<?php

namespace Citadel\Levels\Admin\Controller;

use Citadel\Levels\Admin\Form\LevelType;
use Citadel\Levels\Admin\Form\SettingsType;
use Citadel\Levels\Core\Entity\Level;
use Citadel\Levels\Core\Repository\LevelRepository;
use Forumify\Core\Repository\SettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/levels', 'levels')]
#[IsGranted('levels.admin.levels.view')]
class LevelController extends AbstractController
{

    public function __construct(
       private readonly LevelRepository $levelRepository,
       private readonly SettingRepository $settingRepository,
    ){}

    #[Route('', '_list')]
    public function list(): Response
    {
        return $this->render('@CitadelLevels/admin/levels/list.html.twig', [
            'levels' => $this->levelRepository->findAll()
        ]);
    }

    #[Route('/new', '_new')]
    public function newLevel(Request $request): Response
    {
        return $this->handleLevelForm($request);
    }

    #[Route('/{id}/edit', '_edit')]
    public function editLevel(Request $request, int $id): Response
    {
        return $this->handleLevelForm($request, $id);
    }

    public function handleLevelForm(Request $request, ?int $id = null, ?Level $level = null): Response
    {
        if($id != null) {
            $level = $this->levelRepository->find($id);
        }

        $form = $this->createForm(LevelType::class, $level);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $level = $form->getData();

            $this->levelRepository->save($level);

            $this->addFlash('success', 'Level created.');
            return $this->redirectToRoute('levels_admin_levels_list');
        }

        return $this->render('@CitadelLevels/admin/levels/form.html.twig', [
            'form' => $form->createView(),
            'level' => $level
        ]);
    }

    #[Route('/{id}/delete', '_delete')]
    public function delete(int $id, Request $request): Response
    {
        $level = $this->levelRepository->find($id);
        if (!$request->get('confirmed')) {
            return  $this->render('@CitadelLevels/admin/levels/delete.html.twig', [
                'level' => $level,
            ]);
        }

        $this->levelRepository->remove($level);
        $this->addFlash('success', 'Level removed.');
        return $this->redirectToRoute('levels_admin_levels_list');
    }

    #[Route('/settings', '_settings')]
    public function settings(Request $request): Response
    {
        $form = $this->createForm(SettingsType::class, $this->settingRepository->toFormData('levels'));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->settingRepository->handleFormData($data);

            $this->addFlash('success', 'Settings saved.');
            return $this->redirectToRoute('levels_admin_levels_settings');
        }

        return $this->render('@CitadelLevels/admin/levels/settings.html.twig', [
           'form' => $form->createView(),
        ]);
    }
}