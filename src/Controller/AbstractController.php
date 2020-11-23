<?php


namespace Framework\Controller;


use Framework\Container\ContainerTrait;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractController
{
    use ContainerTrait;

    protected function render(string $templateName, array $variables = []): string
    {
        /** @var Environment $twig */
        $twig = $this->get('app.template_engine');

        $template = $twig->load($templateName);
        return $template->render($variables);
    }
}