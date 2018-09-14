<?php
/**
 * Created by PhpStorm.
 * User: ktokt
 * Date: 14.09.2018
 * Time: 1:56
 */

namespace App\CardPr\Business;


class Letter
{

    private $content = '';
    private $author = '';

    public function __construct(string $content, string $author)
    {
        $this->content = $content;
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }
}
