import { Controller } from '@hotwired/stimulus';
import { Modal } from 'bootstrap';
import * as Turbo from '@hotwired/turbo';

export default class extends Controller {
    static targets = ['modal'];
    modal = null;

    connect() {
        this.boundBeforeFetchResponse = this.beforeFetchResponse.bind(this);
        document.addEventListener('turbo:before-fetch-response', this.boundBeforeFetchResponse);
    }

    disconnect() {
        document.removeEventListener('turbo:before-fetch-response', this.boundBeforeFetchResponse);
    }

    async openModal(event) {
        this.modal = new Modal(this.modalTarget);
        this.modal.show();
    }

    async closeModal(event) {
        // close the remaining modal backdrop
        var modalPiece = Array.from(document.getElementsByClassName('modal-backdrop'));
        modalPiece.forEach(element => element.remove());

    }

    beforeFetchResponse(event) {
        if (!this.modal || !this.modal._isShown) {
            return;
        }

        const fetchResponse = event.detail.fetchResponse;
        if (fetchResponse.succeeded && fetchResponse.redirected) {
            event.preventDefault();
            Turbo.visit(fetchResponse.location);
        }
    }

}
