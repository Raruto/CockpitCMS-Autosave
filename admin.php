<?php

$this("acl")->addResource('autosave', [
  'access',
]);

/**
 * Implements collections.entry.aside event.
 */
$this->on('collections.entry.aside', function ($name) use ($app) {
  if (!$app->module('cockpit')->hasaccess('autosave', 'access')) {
    return;
  }

  $settings = $this->retrieve('config/autosave', ['collections' => []]);
  if ($settings['collections'] === '*' || in_array($name, $settings['collections'])) {
    $this->renderView("autosave:views/partials/autosave-collection-aside.php");
  }
});

/**
 * Implements singletons.form.aside event.
 */
$this->on('singletons.form.aside', function ($name) use ($app) {
  if (!$app->module('cockpit')->hasaccess('autosave', 'access')) {
    return;
  }

  $settings = $this->retrieve('config/autosave', ['singletons' => []]);
  if ($settings['singletons'] === '*' || in_array($name, $settings['singletons'])) {
    $this->renderView("autosave:views/partials/autosave-singleton-aside.php");
  }
});

