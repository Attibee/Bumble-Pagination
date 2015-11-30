<?php
namespace Bumble\Paginator;

/**
 * Description of FixedValidatorTest
 *
 * @author ganth
 */
class JumpingTest extends PaginationTest {
    /**
     * Create the paginator.
     * @return FixedPaginator the paginator
     */
    public function createPaginator() {
        return parent::createPaginator( new Jumping() );
    }
}