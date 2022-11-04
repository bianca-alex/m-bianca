<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field\Textarea;

class CKEditor extends Textarea
{
    protected $view = 'admin.ckeditor';
}
