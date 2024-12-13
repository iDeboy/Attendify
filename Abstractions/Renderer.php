<?php

declare(strict_types=1);

namespace Abstractions;

require_once 'Core/functions.php';

final class Renderer {

    public function __construct(
        private readonly string $app
    ) {
    }

    public function view(string $view, array $data = [], string $layout = null, array $styles = [], array $scripts = []): string {

        $content = render_template($view, $data);

        if (!$layout) $body = $content;
        else $body = render_template($layout, array_merge(['Body' => $content], $data));

        return render_template($this->app, ['Base' => BASE_SITE, 'Body' => $body, 'Styles' => $styles, 'Scripts' => $scripts]);
    }
}
