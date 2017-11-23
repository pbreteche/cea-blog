<?php


namespace Pierre\controller;


class TemplateEngine
{
    const BASE_TEMPLATE = 'base';

    private $layout;
    private $components;

    public function __construct(string $templateConfig)
    {
        $allConfigs = require APP_ROOT . '/config/template.conf.php';

        if (!key_exists($templateConfig, $allConfigs)) {
            throw new \Exception('template config not found');
        }
        $this->layout = $allConfigs[$templateConfig]['layout'];
        $this->components = $allConfigs[$templateConfig]['components'];
     }

    public function render(array $data): string
    {
        $components = $this->renderComponents($data);


        $layout = $this->renderLayout($components);

        return $this->renderFile(self::BASE_TEMPLATE, [
            'layout' => $layout,
            'title' => $data['title'],
        ]);
    }

    /**
     * @param $data
     *
     * @return string[] an collection of rendered components
     */
    private function renderComponents($data): array
    {
        $rendered = [];
        foreach ($this->components as $name => $file) {
            $rendered[$name] = $this->renderFile($file, $data);
        }
        return $rendered;
    }

    private function renderLayout($components): string
    {
        return $this->renderFile('layout/' . $this->layout, $components);
    }

    private function renderFile($path, $data): string
    {
        $fullPath = APP_ROOT . '/src/view/' . $path . '.html.php';
        if (!file_exists($fullPath)) {
            throw new \Exception('File not found: ' . $fullPath);
        }

        extract($data);
        ob_start();
        include $fullPath;
        return ob_get_clean();
    }
}
