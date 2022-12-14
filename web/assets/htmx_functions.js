// put here htmx specific javascript code

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import * as htmx from 'htmx.org';
window.htmx = htmx;

const modal = new bootstrap.Modal(document.getElementById("modal"))

htmx.on("htmx:afterSwap", (e) => {
    // Response targeting #dialog => show the modal
    if (e.detail.target.id == "dialog") {
        modal.show()
    }
})

htmx.on("htmx:beforeSwap", (e) => {
    // Empty response targeting #dialog => hide the modal
    if (e.detail.target.id == "dialog" && !e.detail.xhr.response) {
        modal.hide()
        e.detail.shouldSwap = false
    }
})

// clear the modal content
htmx.on("hidden.bs.modal", () => {
    document.getElementById("dialog").innerHTML = ""
})
