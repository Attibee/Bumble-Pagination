<?php

/* Copyright 2015 Attibee (http://attibee.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Bumble\Pagination;

/**
 * The base paginator inherite by all paginators.
 * 
 * Pagination classes are iterators that allow you to iterate through a list of pages,
 * such as using a foreach statement. A pagination class requires you to set the current
 * page and total number of pages. Each class may have its own extra configuration, such
 * as the number of pages to be shown.
 */
abstract class Pagination implements \Iterator {
    /**
     * The current page for the iterator.
     */
    private $current = 1;

    /**
     * The current page.
     */
    private $currentPageNumber = 1;

    /**
     * The total items in the data set.
     */
    private $totalItems = 0;

    /**
     * Numbers of items to show on each page.
     */
    private $itemsPerPage = 20;

    /**
     * The number of pages to be shown.
     */
    private $numPages = 10;
    
    /**
     * Sets the current page number of the pagination.
     * @param integer $number The current page.
     */
    public function setCurrentPage( $number ) {
        $this->currentPageNumber = $number;
    }
    
    /**
     * Returns the current page number. If the current page was set higher than the
     * maximum number of pages, this returns the maximum page. Likewise, the page must be
     * 1 or above. This prevents an application from accidently setting a page number
     * outside of a range. 
     * 
     * We add this logic to the getter since the current page may be set before we know
     * the total items.
     * 
     * @return number The current page number.
     */
    public function getCurrentPage() {
        $current = $this->currentPageNumber;
        
        if( $current > $this->getTotalPages() ) {
            $current = $this->getTotalPages();
        } else if( $current < 0 ) {
            $current = 1;
        }
        
        return $current;
    }

    /**
     * Sets the total items in the data set.
     * @param integer $count The total items in the data set.
     */
    public function setTotalItems( $count ) {
        $this->totalItems = (integer)$count;
    }

    /**
     * 
     * @param integer $items The numbers of items per page.
     */
    public function setItemsPerPage( $items ) {
        $this->itemsPerPage = (integer)$items;
    }

    /**
     * Returns the total pages.
     * @return integer The total pages.
     */
    public function getTotalPages() {
        return ceil( $this->totalItems / $this->itemsPerPage );
    }

    public function next() {
        ++$this->current;
    }

    public function rewind() {
        $this->current = $this->getFirstPage();
    }

    public function current() {
        return $this->current;
    }

    public function valid() {
        return $this->current <= $this->getLastPage();
    }

    public function key() {
        return $this->current;
    }
    
    public function setNumberPages( $number ) {
        $this->numPages = $number;
    }
    
    public function getNumberPages() {
        return $this->numPages;
    }
    
    abstract protected function getLastPage();
    abstract protected function getFirstPage();
}