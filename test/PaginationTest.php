<?php
namespace Bumble\Pagination;

/**
 * Extended by the Paginator tests. Includes some common methods.
 */
abstract class PaginationTest extends \PHPUnit_Framework_TestCase {
    /**
     * Test correct calculation of total pages
     */
    public function testTotalPages() {
        $p = $this->createPaginator();
        $this->assertTrue( $p->getTotalPages() == 20 );
    }
    
    /**
     * Tests it can be iterated to the end.
     */
    public function testIterator() {
        $p = $this->createPaginator();
        $p->setCurrentPage(1);
        
        foreach( $p as $page );
        
        $this->assertTrue( true );
    }
    
    /**
     * Tests small loops
     */
    public function testSingleItem() {
        $p = $this->createPaginator();
        $p->setCurrentPage(1);
        $p->setTotalItems(1);
        $p->setNumberPages(99);
        $p->setItemsPerPage(1);
        
        $count = 0;
        
        foreach( $p as $page ) {
            $count++;
        }
        
        $this->assertTrue( $count == 1 );
    }
    
    /**
     * Creates the paginator test.
     * @param \Bumble\Paginator\Paginator $p the paginator object
     * @return \Bumble\Paginator\Paginator the paginator object
     */
    protected function createPaginator( Pagination $p = null ) {
        if( !$p ) return null;
        
        $p->setTotalItems(100);
        $p->setNumberPages(5);
        $p->setItemsPerPage(5);
        
        return $p;
    }
}
