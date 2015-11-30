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
 * Jumping pagination will jump from sets of pages as the current page moves.
 * 
 * Jumping pagination will jump from sets of pages as the current page moves. For example,
 * if we set Jumping::setNumberPages(5), and the current page is in parenthesis:
 * 
 * (1) 2  3  4  5
 *  1 (2) 3  4  5
 *  1  2 (3) 4  5
 *  1  2  3 (4) 5
 *  4 (5) 6  7  8
 * 
 * Notice how it jumps to the next set of pages when we get to the end of the first set.
 */
class Jumping extends Pagination {
    protected function getFirstPage() {
        $current = $this->getCurrentPage();
        $pages = $this->getNumberPages();
        
        $start = floor(($current - 2) / ($pages - 2)) * ($pages - 2) + 1;
       
        //keep it above 1
        return $start < 1 ? 1 : $start;
    }
    
    protected function getLastPage() {
        $first = $this->getFirstPage();
        $totalPages = $this->getTotalPages();
        $pages = $this->getNumberPages();
        
        if( $first + $pages > $totalPages ) {
            return $totalPages;
        } else {
            return $this->getFirstPage() + $this->getNumberPages() - 1;
        }
    }
}
