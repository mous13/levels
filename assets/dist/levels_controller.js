import "../styles/levels.css";
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect()
    {
        console.log('Levels connected')
    }
}