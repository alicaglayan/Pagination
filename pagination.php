<?php

/**
 * Pagination Class
 * 
 * @category  Pagination
 * @package   Pagination
 * @author    Ali İhsan ÇAĞLAYAN <ihsancaglayan@gmail.com>
 * @copyright 2015
 * @license   http://opensource.org/licenses/MIT MIT license
 */
class Pagination
{
    protected $maxPerPage  = 10;
    protected $totalCount  = 1;
    protected $currentPage = 1;
    
    /**
     * Set maximum per page count
     *
     * @param int $max per page
     *
     * @return void
     */
    public function setMaxPerPage($max)
    {
        $this->maxPerPage = (int)$max;
        return $this;
    }

    /**
     * Set total database count
     *
     * @param int $count total count
     *
     * @return void
     */
    public function setTotalCount($count)
    {
        $this->totalCount = (int)$count;
        return $this;
    }

    /**
     * Set current page
     *
     * @param int $current current page
     *
     * @return void
     */
    public function setCurrentPage($current)
    {
        $this->currentPage = (int)$current;
        return $this;
    }

    /**
     * Set uri string
     *
     * @param int $string uri string
     *
     * @return void
     */
    public function setUriString($string)
    {
        $this->uriString = (string)rtrim($string, '/');
        return $this;
    }

    /**
     * Get total page count
     *
     * @return integer
     */
    public function getTotalPageCount()
    {
        return ceil($this->totalCount / $this->maxPerPage);
    }

    /**
     * Get start limit
     *
     * @return integer
     */
    public function getStartLimit()
    {
        return ($this->currentPage * $this->maxPerPage) - $this->maxPerPage;
    }

    /**
     * Set maximum per view page
     *
     * @param int $viewCount integer
     *
     * @return self
     */
    public function setMaxPerViewPage($viewCount)
    {
        $this->maxPerShowPage = (int)$viewCount;
        return $this;
    }

    /**
     * Render
     *
     * @return html
     */
    public function render()
    {
        $midMin  = ceil($this->maxPerShowPage / 2);
        $midMax  = ($this->getTotalPageCount() + 1) - $midMin;
        $midPage = $this->currentPage;

        if ($midPage < $midMin) {
            $midPage = $midMin;
        }
        if ($midPage > $midMax) {
            $midPage = $midMax;
        }
        $leftPages  = round($midPage - (($this->maxPerShowPage - 1) / 2));
        $rightPages = round((($this->maxPerShowPage - 1) / 2) + $midPage);

        if ($leftPages < 1) {
            $leftPages = 1;
        }
        if ($rightPages > $this->getTotalPageCount()) {
            $rightPages = $this->getTotalPageCount();
        }
        $htmlPages = '';
        
        if ($this->currentPage != 1) {
            $htmlPages.= '<li><a href="/'. $this->uriString .'/page/1/">First</a></li>';
        }
        if ($this->currentPage != 1) {
            $htmlPages.= '<li><a href="/'. $this->uriString .'/page/'. ($this->currentPage - 1) .'/">Prev</a></li>';
        }

        for ($i = $leftPages; $i <= $rightPages; $i++) {
            if ($this->currentPage == $i) {
                $htmlPages.= '<li><a class="active">'. $i .'</a></li> ';
            } else {
                $htmlPages.= '<li><a href="/'. $this->uriString .'/page/'.$i.'/">'.$i.'</a></li>';
            }
        }
        if ($this->getTotalPageCount() && $this->currentPage != $this->getTotalPageCount()) {
            $htmlPages.= '<li><a href="/'. $this->uriString .'/page/'. ($this->currentPage + 1) .'/">Next</a></li>';
        }
        if ($this->getTotalPageCount() && $this->currentPage != $this->getTotalPageCount()) {
            $htmlPages.= '<li><a href="/'. $this->uriString .'/page/'. $this->getTotalPageCount() .'/">End</a></li>';
        }
        return $htmlPages;
    }
}
