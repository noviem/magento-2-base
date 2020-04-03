<?php
/**
 *
 * Copyright © Noviem.com. All rights reserved.
 * See COPYING.txt for license details.
 *
 */
namespace Noviem\Core\Helper;

class Html
{
    /**
     * @param string $html
     * @return string
     */
    public function removeAttributes(string $html,array $attributes): string
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $xpath = new \DOMXPath($dom);

        foreach ($attributes as $attribute) {
            $query = '//*[@' . $attribute . ']';
            $nodes = $xpath->query($query);

            /** @var \DOMNode $node */
            foreach ($nodes as $node) {
                $node->removeAttribute($attribute);
            }
        }

        libxml_use_internal_errors(false);

        return $dom->saveHTML();
    }
}
