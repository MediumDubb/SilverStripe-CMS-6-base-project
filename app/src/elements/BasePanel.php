<?php

namespace <replace-org>\<replace-psr-theme>\elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\ORM\FieldType\DBHTMLText;

class BasePanel extends BaseElement
{
    private static $table_name = "Elemental_BasePanel";
    private static $singular_name = "Base Panel";
    private static $plural_name = "Base Panels";
    private static $inline_editable = false;
    private static bool $displays_title_in_template = false;
    private const IMAGE_PATH = '/_resources/themes/<replace-theme>/images/';

    private static $db = [
        "Hide"                  => "Boolean",
        "RemoveTopPadding"      => "Boolean",
        "RemoveBottomPadding"   => "Boolean",
        "Heading"               => "Varchar(255)",
        "HeadingLevel"          => "Enum('None,H1,H2,H3', 'H2')",
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            "Hide",
            "RemoveTopPadding",
            "RemoveBottomPadding",
            "TextColor",
            "Heading",
            "HeadingLevel",
        ]);

        $fields->flattenFields()->fieldByName('Title')->setTitle('CMS Title')->setDescription('*Not for front end use');

        $fields->addFieldsToTab(
            "Root.Settings",
            [
                CheckboxField::create("Hide")
                    ->setDescription('Hide this panel from the front end without deleting it'),
                CheckboxField::create("RemoveTopPadding", "Remove Top Padding")
                    ->setDescription('Remove Top Padding from section (removes space between this panel and the panel above)'),
                CheckboxField::create("RemoveBottomPadding", "Remove Bottom Padding")
                    ->setDescription('Remove Bottom Padding from section (removes space between this panel and the panel below)'),
                DropdownField::create("HeadingLevel", "Heading Level", $this->getHeadingLevelsList()),
            ]
        );

        return $fields;
    }

    public function getHeadingLevelsList() {
        return singleton($this->ClassName)->dbObject('HeadingLevel')->enumValues();
    }

    public function forTemplate($holder = true): string
    {
        if ($this->Hide) {
            return "";
        } else {
            return parent::forTemplate($holder);
        }
    }

    public function Heading($class = null): string
    {
        if ($this->HeadingLevel == 'None') {
            return $this->Heading;
        }

        if ($class)
            return DBHTMLText::create()->setValue(sprintf('<%s class="%s">%s</%s>', $this->HeadingLevel, $class, $this->Heading, $this->HeadingLevel));
        else
            return DBHTMLText::create()->setValue(sprintf('<%s>%s</%s>', $this->HeadingLevel, $this->Heading, $this->HeadingLevel));
    }

    public function getToggleCompositePreviewHTML($file): ToggleCompositeField
    {
        $innerHTML = '<div class="form-group">
            <label class="form__field-label"><span style="margin-left:10px;">Panel Preview:</span></label>
            <div class="form__field-holder">' . '<img class="mb-3 w-100 mx-auto" src="'. self::IMAGE_PATH . htmlspecialchars($file) . '">' . '</div>
        </div>';

        if ($this->isMini()) {
            return ToggleCompositeField::create('TogglePanelLayout', 'Panel Preview',
                LiteralField::create(
                    'PanelLayout',
                    $innerHTML
                )
            )->addExtraClass('form__field-holder ms-0');
        } else {
            return ToggleCompositeField::create('TogglePanelLayout', 'Panel Preview',
                LiteralField::create(
                    'PanelLayout',
                    $innerHTML
                )
            );
        }
    }

    public function getToggleCompositeFilesPreviewHTML(string ...$files): ToggleCompositeField
    {
        $html ='';
        $count = 1;
        $innerHTML = '<div class="form-group">
            <label class="form__field-label"><span style="margin-left:10px;">Layout(s):</span></label>
            <div class="form__field-holder">%s</div>
        </div>';

        foreach ($files as $file) {
            $html .= '<p style="margin-left:10px;margin-bottom: 5px;">Preview ' . $count . '</p><img class="mb-3 w-100 mx-auto" src="'. self::IMAGE_PATH . htmlspecialchars($file) . '">';
            $count ++;
        }

        if ($this->isMini()) {
            return ToggleCompositeField::create('TogglePanelLayout', 'Panel Preview',
                LiteralField::create(
                    'PanelLayout',
                    sprintf($innerHTML,$html)
                )
            )->addExtraClass('form__field-holder ms-0');
        } else {
            return ToggleCompositeField::create('TogglePanelLayout', 'Panel Preview',
                LiteralField::create(
                    'PanelLayout',
                    sprintf($innerHTML,$html)
                )
            );
        }
    }

    public function isMini()
    {
        return self::inlineEditable();
    }
}
