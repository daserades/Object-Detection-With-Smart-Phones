<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/datastore/admin/v1/datastore_admin.proto

namespace Google\Cloud\Datastore\Admin\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Metadata common to all Datastore Admin operations.
 *
 * Generated from protobuf message <code>google.datastore.admin.v1.CommonMetadata</code>
 */
class CommonMetadata extends \Google\Protobuf\Internal\Message
{
    /**
     * The time that work began on the operation.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 1;</code>
     */
    private $start_time = null;
    /**
     * The time the operation ended, either successfully or otherwise.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 2;</code>
     */
    private $end_time = null;
    /**
     * The type of the operation. Can be used as a filter in
     * ListOperationsRequest.
     *
     * Generated from protobuf field <code>.google.datastore.admin.v1.OperationType operation_type = 3;</code>
     */
    private $operation_type = 0;
    /**
     * The client-assigned labels which were provided when the operation was
     * created. May also include additional labels.
     *
     * Generated from protobuf field <code>map<string, string> labels = 4;</code>
     */
    private $labels;
    /**
     * The current state of the Operation.
     *
     * Generated from protobuf field <code>.google.datastore.admin.v1.CommonMetadata.State state = 5;</code>
     */
    private $state = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Protobuf\Timestamp $start_time
     *           The time that work began on the operation.
     *     @type \Google\Protobuf\Timestamp $end_time
     *           The time the operation ended, either successfully or otherwise.
     *     @type int $operation_type
     *           The type of the operation. Can be used as a filter in
     *           ListOperationsRequest.
     *     @type array|\Google\Protobuf\Internal\MapField $labels
     *           The client-assigned labels which were provided when the operation was
     *           created. May also include additional labels.
     *     @type int $state
     *           The current state of the Operation.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Datastore\Admin\V1\DatastoreAdmin::initOnce();
        parent::__construct($data);
    }

    /**
     * The time that work began on the operation.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 1;</code>
     * @return \Google\Protobuf\Timestamp
     */
    public function getStartTime()
    {
        return isset($this->start_time) ? $this->start_time : null;
    }

    public function hasStartTime()
    {
        return isset($this->start_time);
    }

    public function clearStartTime()
    {
        unset($this->start_time);
    }

    /**
     * The time that work began on the operation.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp start_time = 1;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setStartTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->start_time = $var;

        return $this;
    }

    /**
     * The time the operation ended, either successfully or otherwise.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 2;</code>
     * @return \Google\Protobuf\Timestamp
     */
    public function getEndTime()
    {
        return isset($this->end_time) ? $this->end_time : null;
    }

    public function hasEndTime()
    {
        return isset($this->end_time);
    }

    public function clearEndTime()
    {
        unset($this->end_time);
    }

    /**
     * The time the operation ended, either successfully or otherwise.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 2;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setEndTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->end_time = $var;

        return $this;
    }

    /**
     * The type of the operation. Can be used as a filter in
     * ListOperationsRequest.
     *
     * Generated from protobuf field <code>.google.datastore.admin.v1.OperationType operation_type = 3;</code>
     * @return int
     */
    public function getOperationType()
    {
        return $this->operation_type;
    }

    /**
     * The type of the operation. Can be used as a filter in
     * ListOperationsRequest.
     *
     * Generated from protobuf field <code>.google.datastore.admin.v1.OperationType operation_type = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setOperationType($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Datastore\Admin\V1\OperationType::class);
        $this->operation_type = $var;

        return $this;
    }

    /**
     * The client-assigned labels which were provided when the operation was
     * created. May also include additional labels.
     *
     * Generated from protobuf field <code>map<string, string> labels = 4;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * The client-assigned labels which were provided when the operation was
     * created. May also include additional labels.
     *
     * Generated from protobuf field <code>map<string, string> labels = 4;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setLabels($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->labels = $arr;

        return $this;
    }

    /**
     * The current state of the Operation.
     *
     * Generated from protobuf field <code>.google.datastore.admin.v1.CommonMetadata.State state = 5;</code>
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * The current state of the Operation.
     *
     * Generated from protobuf field <code>.google.datastore.admin.v1.CommonMetadata.State state = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setState($var)
    {
        GPBUtil::checkEnum($var, \Google\Cloud\Datastore\Admin\V1\CommonMetadata\State::class);
        $this->state = $var;

        return $this;
    }

}

