<?php
/**
 * File: OwnerView.class.php
 * Description: View layer for owner operations. Renders templates and includes navigation and message components.
 * Follows MVC pattern by separating presentation logic from business logic.
 */

class OwnerView {
    
    public function __construct() {

    }

    /**
     * Renders page with navigation menu, template content, and message display
     * Always includes MainMenu and MessageForm for consistent page structure
     * Optional template file allows flexible content rendering
     * 
     * @param string|null $template Path to template file to include
     * @param mixed $content Data object/array to pass to template (accessible as $content variable)
     * @return void
     */
    public function display($template=NULL, $content=NULL) {
        include("view/menu/MainMenu.html");
        echo '<div id="content">';
        
        include("view/form/MessageForm.php");
        
        if (!empty($template)) {
            include($template);
        }
        
        echo '</div>';
    }    

}
