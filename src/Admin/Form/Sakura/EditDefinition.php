<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Admin\Form\Sakura;

use Admin\Field\Sakura\SakuraListField;
use Admin\Field\Sakura\SakuraModalField;
use Phoenix\Form\Filter\UtcFilter;
use Phoenix\Form\PhoenixFieldTrait;
use Windwalker\Core\Form\AbstractFieldDefinition;
use Windwalker\Form\Filter\MaxLengthFilter;
use Windwalker\Form\Form;
use Windwalker\Validator\Rule;

/**
 * The SakuraEditDefinition class.
 *
 * @since  1.0
 */
class EditDefinition extends AbstractFieldDefinition
{
    use PhoenixFieldTrait;

    /**
     * Define the form fields.
     *
     * @param Form $form The Windwalker form object.
     *
     * @return  void
     *
     * @throws \InvalidArgumentException
     */
    public function doDefine(Form $form)
    {
        // Basic fieldset
        $this->fieldset('basic', function (Form $form) {
            // ID
            $this->hidden('id');

            // Title
            $this->text('title')
                ->label(__('mass.sakura.field.title'))
                ->addFilter('trim')
                ->maxlength(255)
                ->required(true);

            // Alias
            $this->text('alias')
                ->label(__('mass.sakura.field.alias'))
                ->description(__('mass.sakura.field.alias.desc'))
                ->maxlength(255);

            // Image
            $this->text('image')
                ->label(__('mass.sakura.field.image'))
                ->maxlength(255);

            // URL
            $this->text('url')
                ->label(__('mass.sakura.field.url'))
                ->maxlength(255)
                ->addValidator(Rule\UrlValidator::class)
                ->attr('data-validate', 'url');

            // Example: Sakura List
            // TODO: Please remove this field in production
            $this->add('sakura_list', SakuraListField::class)
                ->label('List Example')
                ->option('- Select Sakura Example -', '')
                ->addClass('has-select2');

            // Example: Sakura Modal
            // TODO: Please remove this field in production
            $this->add('sakura_modal', SakuraModalField::class)
                ->label('Modal Example')
                ->set('placeholder', 'Select Sakura Example');
        });

        // Text Fieldset
        $this->fieldset('text', function (Form $form) {
            // Introtext
            $this->textarea('introtext')
                ->label(__('mass.sakura.field.introtext'))
                ->maxlength(static::TEXT_MAX_UTF8)
                ->rows(10);

            // Fulltext
            $this->textarea('fulltext')
                ->label(__('mass.sakura.field.fulltext'))
                ->maxlength(static::TEXT_MAX_UTF8)
                ->rows(10);
        });

        // Created fieldset
        $this->fieldset('created', function (Form $form) {
            // State
            $this->switch('state')
                ->label(__('mass.sakura.field.published'))
                ->class('')
                ->color('success')
                ->circle(true)
                ->defaultValue(1);

            // Created
            $this->calendar('created')
                ->label(__('mass.sakura.field.created'))
                ->addFilter(UtcFilter::class);

            // Modified
            $this->calendar('modified')
                ->label(__('mass.sakura.field.modified'))
                ->addFilter(UtcFilter::class)
                ->disabled();

            // Author
            $this->text('created_by')
                ->label(__('mass.sakura.field.author'));

            // Modified User
            $this->text('modified_by')
                ->label(__('mass.sakura.field.modifiedby'))
                ->disabled();
        });
    }
}
