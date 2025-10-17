<?php

namespace InnisMaggiore\InnisMaggioreTheme\siteconfig;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\RedirectorPage;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

class CustomSiteConfig extends Extension
{
    private static $db = [
        'GoogleTagManagerID'        => 'Varchar(25)',
        'Copyright'                 => 'Varchar(100)',
        'DisableSiteSearch'         => 'Boolean',
    ];

    private static $has_one = [
        'Logo'                      => Image::class,
        'FooterLogo'                => Image::class,
        'Favicon'                   => Image::class,
    ];

    private static $owns = [
        'Logo',
        'FooterLogo',
        'Favicon',
    ];

    private static $many_many = [
        'FooterLinks'               => RedirectorPage::class,
        'SocialLinks'               => SocialLink::class,
    ];

    private static $many_many_extraFields = [
        'FooterLinks' => [
            'FooterLinksSortOrder' => 'Int',
        ],
        'SocialLinks' => [
            'SocialLinksSortOrder' => 'Int',
        ]
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName([
            'FooterLinks',
            'SocialLinks',
            'Copyright',
            'Favicon',
            'DisableSiteSearch',
        ]);

        $fields->addFieldsToTab('Root.Main', [
            UploadField::create('Favicon', 'Favicon')
                ->setFolderName('Uploads'),
            UploadField::create('Logo', 'Logo')
                ->setFolderName('Logos'),
        ]);

        $fields->addFieldToTab('Root.Main',
            HeaderField::create('IdentityHeading', 'Site Identity'),
            'Title'
        );

        // Footer
        $fields->addFieldsToTab(
            'Root.Footer',
            [
                UploadField::create('FooterLogo', 'Footer Logo')
                    ->setFolderName('Logos'),
                GridField::create('SocialLinks',
                    'Social Links',
                    $this->getSortedSocialLinks(),
                    GridFieldConfig_RecordEditor::create()
                        ->addComponent(new GridFieldSortableRows('SocialLinksSortOrder'))
                ),
                GridField::create('FooterLinks',
                    'Footer Nav Links',
                    $this->getSortedFooterLinks(),
                    GridFieldConfig_RecordEditor::create()
                        ->addComponent(new GridFieldSortableRows('FooterLinksSortOrder'))
                ),
                TextField::create('Copyright', 'Copyright')
                    ->addExtraClass('pt-3'),
            ]
        );

        $fields->findOrMakeTab('Root.Analytics')->setTitle('Analytics');
        $fields->addFieldsToTab('Root.Analytics', [
            TextField::create('GoogleTagManagerID', 'Google Tag Manager ID'),
            TextField::create('GoogleMapsAPIKey', 'Google Maps API Key')->setInputType('password'),
        ]);
    }
}
