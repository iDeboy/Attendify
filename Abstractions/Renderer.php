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

        $layout ??= $data['layout'] ?? null;

        if (!$layout) $body = $content;
        else $body = render_template($layout, ['Body' => $content]);

        return render_template($this->app, ['Body' => $body, 'Styles' => $styles, 'Scripts' => $scripts]);
    }
}
