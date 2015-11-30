<?php
namespace Bumble\Pagination;

/**
 * Description of FixedValidatorTest
 *
 * @author ganth
 */
class FixedTest extends PaginationTest {
    /**
     * Create the paginator.
     * @return FixedPaginator the paginator
     */
    public function createPaginator() {
        return parent::createPaginator( new Fixed() );
    }
}