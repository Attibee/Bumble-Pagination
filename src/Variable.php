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
 * Variable pagination will show a variable number of pages.
 * 
 * Variable pagination will show a variable number of pages. There will always be half of
 * the total number of shown pages on either side of the current page. For example, where
 * the current page is in parenthesis:
 * 
 * (1) 2 3
 * 1 (2) 3 4
 * 1 2 (3) 4 5
 * 2 3 (4) 5 6
 */
class Variable extends Pagination {
    protected function getFirstPage() {
        $current = $this->getCurrentPage();
        $before = $current - 1;
        $half = round( $this->getNumberPages() / 2 );
        
        //pages before current less than half
        if( $before < $half ) {
            return 1;
        }
        
        return $current - $half + 1;
    }
    
    protected function getLastPage() {
        $current = $this->getCurrentPage();
        $after = $this->getTotalPages() - $current;
        $half = round( $this->getNumberPages() / 2 );

        if( $after < $half ) {
            return $this->getTotalPages();
        }
        
        return $current + $half - 1;
    }
}
