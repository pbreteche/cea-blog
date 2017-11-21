<?php


namespace Pierre\controller;


class TemplateEngine
{
    public function render(string $templateName, array $data): string
    {
        $templatePath = APP_ROOT . '/src/view/' . $templateName . '.html.php';
        if (!file_exists($templatePath)) {
            throw new \Exception('template file not found');
        }

        extract($data);

        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

}
