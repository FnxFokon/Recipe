<?php

namespace Core\View;

use App\Controller\AuthController;

class View
{
    // On définit le chemin absolu vers le dossier contenant les vues
    // On peut réutiliser les constantes de index.php
    public const PATH_VIEW = PATH_ROOT . 'views' . DS;

    // On recupere le chemin de notre dossier _templates
    public const PATH_PARTIALS = self::PATH_VIEW . '_templates' . DS;

    // On déclare une propriété titre
    public string $title = 'Titre par défaut';

    // On déclare notre constructeur
    public function __construct(
        private string $name,
        private bool $is_complete = true
    ) {
    }

    // On crée une méthode pour récupérer le chemin de la vue
    private function getRequirePath(): string
    {
        $arr_name = explode('/', $this->name);
        $category =  $arr_name[0];
        $name = $arr_name[1];
        $name_prefix = $this->is_complete ? '' : '_';

        return self::PATH_VIEW . $category . DS . $name_prefix . $name . '.html.php';
    }

    // On crée notre méthode de rendu
    public function render(?array $view_data = []): void
    {
        // on check ici si l'utilisateur est en session
        // Sinon on redirige vers la page de connexion
        $auth = AuthController::class;
        if (!empty($view_data)) {
            extract($view_data);
        }

        // Mise en cache du résultat
        ob_start();

        // On import le template _header
        if ($this->is_complete) {
            require self::PATH_PARTIALS . '_header.html.php';
        }


        // On inclut le fichier de la vue
        require $this->getRequirePath();

        // On import le template _footer
        if ($this->is_complete) {
            require self::PATH_PARTIALS . '_footer.html.php';
        }

        // Libération du cache
        ob_end_flush();
    }
}
