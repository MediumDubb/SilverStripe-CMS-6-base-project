<?php

namespace <replace-org>\<replace-psr-theme>\pagetypes;

use SilverStripe\Forms\FieldList;

class ComponentPage extends \Page
{
    private static string $table_name = "ComponentPage";
    private static string $singular_name = "Component Page";
    private static string $plural_name = "Component Pages";
    private static string $description = "A buildable page with arrangeable custom panels";

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Content', 'H1']);

        return $fields;
    }


    public function onBeforeWrite() {
        $this->Content = $this->collateSearchContent();

        parent::onBeforeWrite();
    }


    protected function collateSearchContent() {
        $content = $this->getOwner()->getElementsForSearch();
        // Clean up the content
        return preg_replace('/\s+/', ' ', $content);
    }

    public function forTemplate(): string
    {
        return $this->Title;
    }
}
