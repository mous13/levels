<?php

namespace Citadel\Levels\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Citadel\Levels\Admin\Form\SettingsType;
use Forumify\Core\Repository\SettingRepository;
use Forumify\Plugin\Attribute\PluginVersion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/settings', 'settings')]
#[IsGranted('levels.admin.levels.manage')]
#[PluginVersion('citadel/levels', 'premium')]
class SettingsController extends AbstractController
{
    public function __construct(
        private readonly SettingRepository $settingRepository
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(SettingsType::class, $this->settingRepository->toFormData('levels'));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $this->settingRepository->handleFormData($data);

            $this->addFlash('success', 'Settings saved.');
            return $this->redirectToRoute('levels_admin_settings');
        }

        return $this->render(
            '@CitadelLevels/admin/levels/settings.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
