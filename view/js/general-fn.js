/**
 * File: general-fn.js
 * Description: General utility functions for form handling and user interactions.
 * Provides confirmation dialogs and form submission helpers.
 */

/**
 * Prompts user for delete confirmation and submits the form if confirmed
 * @param {string} form_id - The ID of the form to submit
 */
function form_delete(form_id) {
    if (confirm("Delete?")) {
        document.getElementById(form_id).submit();
    }
}

/**
 * Submits a form for reset action
 * @param {string} form_id - The ID of the form to submit
 */
function form_reset(form_id) {
    document.getElementById(form_id).submit();
}
