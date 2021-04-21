<?php
/**
 * @OA\Schema(
 *      title="Service",
 *      description="Service body data",
 *      type="object"
 * )
 */
class Service {
    /**
     * @OA\Property(
     *      title="name",
     *      description="Switch of close Service",
     *      example="false"
     * )
     *
     * @var boolean
     */
    public $service_close;

    /**
     * @OA\Property(
     *      title="service_id",
     *      description="Service id",
     *      example="1"
     * )
     *
     * @var int
     */
    public $service_id;

     /**
     * @OA\Property(
     *      title="table_id",
     *      description="Table id",
     *      example="1"
     * )
     *
     * @var int
     */
    public $table_id;

    
    

   
}