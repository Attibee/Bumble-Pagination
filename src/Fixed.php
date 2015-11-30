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

namespace Attibee\Pagination;

/**
 * Fixed pagination will always attempt to show a fixed number of pages.
 * 
 * Fixed pagination will always attempt to show a fixed number of pages. For example, if
 * we set Fixed::setNumberPages(5), it will always show 5 pages. Consider the following
 * example, where the value in parenthesis is the current page:
 * 
 * (1) 2 3 4 5
 * 1 (2) 3 4 5
 * 1 2 (3) 4 5
 * 2 3 (4) 5 6
 * 3 4 (5) 6 7
 * 
 */
class Fixed extends Pagination {
    protected function getFirstPage() {
        $current = $this->getCurrentPage();
        $before = $current - 1;
        $half = round( $this->getNumberPages() / 2 );
        $after = $this->getTotalPages() - $current;
        
        //pages before current less than half
        if( $before < $half ) {
            return 1;
        //after doesn't have enough, let's add to before
        } elseif( $after < $half ) {
            $start = $this->getTotalPages() - $this->getNumberPages() + 1;
            
            return $start < 1 ? 1 : $start;
        }
        
        return $current - $half + 1;
    }
    
    protected function getLastPage() {
        $totalPages = $this->getTotalPages();
        $current = $this->getCurrentPage();
        $after = $totalPages - $current;
        $before = $current - 1;
        $half = round( $this->getNumberPages() / 2 );
        
        if( $after < $half ) {
            return $this->getTotalPages();
        } elseif( $before < $half ) {
            $end = $this->getNumberPages();
            
            return $end > $totalPages ? $totalPages : $end;
        }
        
        return $current + $half - 1;
    }
}
