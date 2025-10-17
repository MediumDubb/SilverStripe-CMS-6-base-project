<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\Search\FulltextSearchable;

FulltextSearchable::enable([SiteTree::class]);
