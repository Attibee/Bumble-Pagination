<?php
namespace Bumble\Pagination;

/**
 * Description of FixedValidatorTest
 *
 * @author ganth
 */
class VariableTest extends PaginationTest {
    /**
     * Create the paginator.
     * @return FixedPaginator the paginator
     */
    public function createPaginator() {
        return parent::createPaginator( new Variable() );
    }
}