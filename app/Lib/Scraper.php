<?php

namespace App\Lib;

use App\Article;
use Goutee\Client as GoutteClient;

/**
 * Class Scraper
 * 使用處理爬蟲
 * 第一步使用過濾器過濾item
 * 第二步使用匿名回乎函式在過濾韓式之中並迭代出值
 * 儲存結果到article table
 */

 class Scraper
 {
     protected $client;
     public $results = [];
     public $savedItems = 0;
     public $status = 1;

     public function __construct(GoutteClient $client)
     {
        $this->client = $client;
     }

     public function handle($linkObj)
     {
         try {
            $crawler = $this->client->request('GET', $linkObj->url);
            $translateExpression = $this->translateCSSExpression($linkObj->itemSch->css_exp);

            if (isset($translateExpression['title'])) {
                $data = [];

                //filter
                $crawler->filter($linkObj->main_filter_selec)->each(function($node) use($translateExpression, $data, $linkObj) {
                    //$node可以深入tree子元素
                    foreach ($translateExpression as $key => $val) {
                        if ($node->filter($val['selector'])->count() > 0) {
                            if ($val['is_attribute'] == false) {
                                $data[$key][] = preg_replace("#\n|'|\"#", '', $node->filter($val['selector'])->text());
                            }else {
                                if ($key == 'source_link') {
                                    $item_link = $node->filter($val['selector'])->attr($val['attr']);
                                    
                                    // 當網站的文章不是完整url時append 
                                    if ($linkObj->itemSch->is_full_url == 0) {
                                        $item_link = $linkObj->website->url . $node->filter($val['selector'])->attr($val['attr']);
                                    }

                                    $data[$key][] = $item_link;
                                    $data['content'][] = $this->fetchFullContent($item_link, $linkObj->itemSch->full_content_selec);
                                } else {
                                $data[$key][] = $node->filter($val['selector'])->attr($val['attr']);
                                }
                            }  
                        }
                    }
                    $data['category_id'][] = $linkObj->category->id;
                    $daat['website_id'][] = $linkObj->website->id;
                });
                $this->save($data);

                $this->results = $data;
            }
         } catch(\Exception $ex) {
            $this->status = $ex->getMessage();
         }
     }
     /*
        fetchFullContent
        method pull full content of a single item use item url and selector
        @param $item_url
        @param $selector
        @return string
     */

    protected function fetchFullContent( $item_url ,$selector)
     {
         try {
            $crawler = $this->client->request('GET', $item_url);

            return $crawler->filter($selector)->html();
         } catch(\Exception $ex) {
            return "";
         }
     }

     protected function save($data)
     {
         foreach ($data['title'] as $k => $val) {
             $checkExist = Article::where('source_link', $data['source_link'][$k])->first();

             if (!isset($checkExist->id)) {
                 $article = new Article();

                 $article->title = $val;

                 $article->excerpt = isset($data['excerpt'][$k]) ? $data['excerpt'][$k] : "";

                 $article->content = isset($data['content'][$k]) ? $data['content'][$k] : "";

                 $article->image = isset($data['image'][$k]) ? $data['image'][$k] : "";

                 $article->source_link = $data['source_link'][$k];

                 $article->category_id = $data['category_id'][$k];

                 $article->website_id = $data['website_id'][$k];

                 $article->save();

                 $this->saveItems++;


             }
         }
     }

    /*
        translateCSSExpression
        translate css expression into corresponding fields and sub selector
        @param $expression

        @return array
    */
    protected function translateCSSExpression($expression) 
    {
        $expArr = explode("||", $expression);

        //regex match
        $regex = '/(.*?)\[(.*)\]/m';

        $fields = [];

        foreach ($expArr as $subExp) {
            preg_match($regex, $subExp, $matches);

            if(isset($matches[1]) && isset($matches[2])) {

                $is_attribute = false;

                $selector = $matches[2];

                $attr = "";

                // this cond meet then this is attribute like img[src] or a[href]
                if(strpos($selector,"[") !== false && strpos($selector,"]") !== false) {
                    $is_attribute = true;

                    preg_match($regex, $matches[2], $matches_attr);

                    $selector = $matches_attr[1];

                    $attr = $matches_attr[2];
                }

                $fields[$matches[1]] = ['field' => $matches[1], 'is_attribute' => $is_attribute, 'selector' => $selector, 'attr' => $attr];
            }
        }
        return $fields;
    }
 }