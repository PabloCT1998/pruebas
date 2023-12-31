<?php
/**
 * HubDbTableV3
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  HubSpot\Client\Cms\Hubdb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * HubDB endpoints
 *
 * HubDB is a relational data store that presents data as rows, columns, and cells in a table, much like a spreadsheet. HubDB tables can be added or modified [in the HubSpot CMS](https://knowledge.hubspot.com/cos-general/how-to-edit-hubdb-tables), but you can also use the API endpoints documented here. For more information on HubDB tables and using their data on a HubSpot site, see the [CMS developers site](https://designers.hubspot.com/docs/tools/hubdb). You can also see the [documentation for dynamic pages](https://designers.hubspot.com/docs/tutorials/how-to-build-dynamic-pages-with-hubdb) for more details about the `useForPages` field.  HubDB tables support `draft` and `published` versions. This allows you to update data in the table, either for testing or to allow for a manual approval process, without affecting any live pages using the existing data. Draft data can be reviewed, and published by a user working in HubSpot or published via the API. Draft data can also be discarded, allowing users to go back to the published version of the data without disrupting it. If a table is set to be `allowed for public access`, you can access the published version of the table and rows without any authentication by specifying the portal id via the query parameter `portalId`.
 *
 * The version of the OpenAPI document: v3
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace HubSpot\Client\Cms\Hubdb\Model;

use \ArrayAccess;
use \HubSpot\Client\Cms\Hubdb\ObjectSerializer;

/**
 * HubDbTableV3 Class Doc Comment
 *
 * @category Class
 * @description Model for HubDB table
 * @package  HubSpot\Client\Cms\Hubdb
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class HubDbTableV3 implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'HubDbTableV3';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'label' => 'string',
        'columns' => '\HubSpot\Client\Cms\Hubdb\Model\Column[]',
        'published' => 'bool',
        'deleted' => 'bool',
        'column_count' => 'int',
        'row_count' => 'int',
        'created_by' => '\HubSpot\Client\Cms\Hubdb\Model\SimpleUser',
        'updated_by' => '\HubSpot\Client\Cms\Hubdb\Model\SimpleUser',
        'use_for_pages' => 'bool',
        'allow_child_tables' => 'bool',
        'enable_child_table_pages' => 'bool',
        'is_ordered_manually' => 'bool',
        'dynamic_meta_tags' => 'array<string,int>',
        'allow_public_api_access' => 'bool',
        'created_at' => '\DateTime',
        'published_at' => '\DateTime',
        'updated_at' => '\DateTime'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'name' => null,
        'label' => null,
        'columns' => null,
        'published' => null,
        'deleted' => null,
        'column_count' => 'int32',
        'row_count' => 'int32',
        'created_by' => null,
        'updated_by' => null,
        'use_for_pages' => null,
        'allow_child_tables' => null,
        'enable_child_table_pages' => null,
        'is_ordered_manually' => null,
        'dynamic_meta_tags' => 'int32',
        'allow_public_api_access' => null,
        'created_at' => 'date-time',
        'published_at' => 'date-time',
        'updated_at' => 'date-time'
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'name' => 'name',
        'label' => 'label',
        'columns' => 'columns',
        'published' => 'published',
        'deleted' => 'deleted',
        'column_count' => 'columnCount',
        'row_count' => 'rowCount',
        'created_by' => 'createdBy',
        'updated_by' => 'updatedBy',
        'use_for_pages' => 'useForPages',
        'allow_child_tables' => 'allowChildTables',
        'enable_child_table_pages' => 'enableChildTablePages',
        'is_ordered_manually' => 'isOrderedManually',
        'dynamic_meta_tags' => 'dynamicMetaTags',
        'allow_public_api_access' => 'allowPublicApiAccess',
        'created_at' => 'createdAt',
        'published_at' => 'publishedAt',
        'updated_at' => 'updatedAt'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'label' => 'setLabel',
        'columns' => 'setColumns',
        'published' => 'setPublished',
        'deleted' => 'setDeleted',
        'column_count' => 'setColumnCount',
        'row_count' => 'setRowCount',
        'created_by' => 'setCreatedBy',
        'updated_by' => 'setUpdatedBy',
        'use_for_pages' => 'setUseForPages',
        'allow_child_tables' => 'setAllowChildTables',
        'enable_child_table_pages' => 'setEnableChildTablePages',
        'is_ordered_manually' => 'setIsOrderedManually',
        'dynamic_meta_tags' => 'setDynamicMetaTags',
        'allow_public_api_access' => 'setAllowPublicApiAccess',
        'created_at' => 'setCreatedAt',
        'published_at' => 'setPublishedAt',
        'updated_at' => 'setUpdatedAt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'label' => 'getLabel',
        'columns' => 'getColumns',
        'published' => 'getPublished',
        'deleted' => 'getDeleted',
        'column_count' => 'getColumnCount',
        'row_count' => 'getRowCount',
        'created_by' => 'getCreatedBy',
        'updated_by' => 'getUpdatedBy',
        'use_for_pages' => 'getUseForPages',
        'allow_child_tables' => 'getAllowChildTables',
        'enable_child_table_pages' => 'getEnableChildTablePages',
        'is_ordered_manually' => 'getIsOrderedManually',
        'dynamic_meta_tags' => 'getDynamicMetaTags',
        'allow_public_api_access' => 'getAllowPublicApiAccess',
        'created_at' => 'getCreatedAt',
        'published_at' => 'getPublishedAt',
        'updated_at' => 'getUpdatedAt'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = $data['id'] ?? null;
        $this->container['name'] = $data['name'] ?? null;
        $this->container['label'] = $data['label'] ?? null;
        $this->container['columns'] = $data['columns'] ?? null;
        $this->container['published'] = $data['published'] ?? null;
        $this->container['deleted'] = $data['deleted'] ?? null;
        $this->container['column_count'] = $data['column_count'] ?? null;
        $this->container['row_count'] = $data['row_count'] ?? null;
        $this->container['created_by'] = $data['created_by'] ?? null;
        $this->container['updated_by'] = $data['updated_by'] ?? null;
        $this->container['use_for_pages'] = $data['use_for_pages'] ?? null;
        $this->container['allow_child_tables'] = $data['allow_child_tables'] ?? null;
        $this->container['enable_child_table_pages'] = $data['enable_child_table_pages'] ?? null;
        $this->container['is_ordered_manually'] = $data['is_ordered_manually'] ?? null;
        $this->container['dynamic_meta_tags'] = $data['dynamic_meta_tags'] ?? null;
        $this->container['allow_public_api_access'] = $data['allow_public_api_access'] ?? null;
        $this->container['created_at'] = $data['created_at'] ?? null;
        $this->container['published_at'] = $data['published_at'] ?? null;
        $this->container['updated_at'] = $data['updated_at'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['label'] === null) {
            $invalidProperties[] = "'label' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id Id of the table
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Name of the table
     *
     * @return self
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->container['label'];
    }

    /**
     * Sets label
     *
     * @param string $label Label of the table
     *
     * @return self
     */
    public function setLabel($label)
    {
        $this->container['label'] = $label;

        return $this;
    }

    /**
     * Gets columns
     *
     * @return \HubSpot\Client\Cms\Hubdb\Model\Column[]|null
     */
    public function getColumns()
    {
        return $this->container['columns'];
    }

    /**
     * Sets columns
     *
     * @param \HubSpot\Client\Cms\Hubdb\Model\Column[]|null $columns List of columns in the table
     *
     * @return self
     */
    public function setColumns($columns)
    {
        $this->container['columns'] = $columns;

        return $this;
    }

    /**
     * Gets published
     *
     * @return bool|null
     */
    public function getPublished()
    {
        return $this->container['published'];
    }

    /**
     * Sets published
     *
     * @param bool|null $published published
     *
     * @return self
     */
    public function setPublished($published)
    {
        $this->container['published'] = $published;

        return $this;
    }

    /**
     * Gets deleted
     *
     * @return bool|null
     */
    public function getDeleted()
    {
        return $this->container['deleted'];
    }

    /**
     * Sets deleted
     *
     * @param bool|null $deleted deleted
     *
     * @return self
     */
    public function setDeleted($deleted)
    {
        $this->container['deleted'] = $deleted;

        return $this;
    }

    /**
     * Gets column_count
     *
     * @return int|null
     */
    public function getColumnCount()
    {
        return $this->container['column_count'];
    }

    /**
     * Sets column_count
     *
     * @param int|null $column_count Number of columns including deleted
     *
     * @return self
     */
    public function setColumnCount($column_count)
    {
        $this->container['column_count'] = $column_count;

        return $this;
    }

    /**
     * Gets row_count
     *
     * @return int|null
     */
    public function getRowCount()
    {
        return $this->container['row_count'];
    }

    /**
     * Sets row_count
     *
     * @param int|null $row_count Number of rows in the table
     *
     * @return self
     */
    public function setRowCount($row_count)
    {
        $this->container['row_count'] = $row_count;

        return $this;
    }

    /**
     * Gets created_by
     *
     * @return \HubSpot\Client\Cms\Hubdb\Model\SimpleUser|null
     */
    public function getCreatedBy()
    {
        return $this->container['created_by'];
    }

    /**
     * Sets created_by
     *
     * @param \HubSpot\Client\Cms\Hubdb\Model\SimpleUser|null $created_by created_by
     *
     * @return self
     */
    public function setCreatedBy($created_by)
    {
        $this->container['created_by'] = $created_by;

        return $this;
    }

    /**
     * Gets updated_by
     *
     * @return \HubSpot\Client\Cms\Hubdb\Model\SimpleUser|null
     */
    public function getUpdatedBy()
    {
        return $this->container['updated_by'];
    }

    /**
     * Sets updated_by
     *
     * @param \HubSpot\Client\Cms\Hubdb\Model\SimpleUser|null $updated_by updated_by
     *
     * @return self
     */
    public function setUpdatedBy($updated_by)
    {
        $this->container['updated_by'] = $updated_by;

        return $this;
    }

    /**
     * Gets use_for_pages
     *
     * @return bool|null
     */
    public function getUseForPages()
    {
        return $this->container['use_for_pages'];
    }

    /**
     * Sets use_for_pages
     *
     * @param bool|null $use_for_pages Specifies whether the table can be used for creation of dynamic pages
     *
     * @return self
     */
    public function setUseForPages($use_for_pages)
    {
        $this->container['use_for_pages'] = $use_for_pages;

        return $this;
    }

    /**
     * Gets allow_child_tables
     *
     * @return bool|null
     */
    public function getAllowChildTables()
    {
        return $this->container['allow_child_tables'];
    }

    /**
     * Sets allow_child_tables
     *
     * @param bool|null $allow_child_tables Specifies whether child tables can be created
     *
     * @return self
     */
    public function setAllowChildTables($allow_child_tables)
    {
        $this->container['allow_child_tables'] = $allow_child_tables;

        return $this;
    }

    /**
     * Gets enable_child_table_pages
     *
     * @return bool|null
     */
    public function getEnableChildTablePages()
    {
        return $this->container['enable_child_table_pages'];
    }

    /**
     * Sets enable_child_table_pages
     *
     * @param bool|null $enable_child_table_pages Specifies creation of multi-level dynamic pages using child tables
     *
     * @return self
     */
    public function setEnableChildTablePages($enable_child_table_pages)
    {
        $this->container['enable_child_table_pages'] = $enable_child_table_pages;

        return $this;
    }

    /**
     * Gets is_ordered_manually
     *
     * @return bool|null
     */
    public function getIsOrderedManually()
    {
        return $this->container['is_ordered_manually'];
    }

    /**
     * Sets is_ordered_manually
     *
     * @param bool|null $is_ordered_manually is_ordered_manually
     *
     * @return self
     */
    public function setIsOrderedManually($is_ordered_manually)
    {
        $this->container['is_ordered_manually'] = $is_ordered_manually;

        return $this;
    }

    /**
     * Gets dynamic_meta_tags
     *
     * @return array<string,int>|null
     */
    public function getDynamicMetaTags()
    {
        return $this->container['dynamic_meta_tags'];
    }

    /**
     * Sets dynamic_meta_tags
     *
     * @param array<string,int>|null $dynamic_meta_tags Specifies the key value pairs of the metadata fields with the associated column ids
     *
     * @return self
     */
    public function setDynamicMetaTags($dynamic_meta_tags)
    {
        $this->container['dynamic_meta_tags'] = $dynamic_meta_tags;

        return $this;
    }

    /**
     * Gets allow_public_api_access
     *
     * @return bool|null
     */
    public function getAllowPublicApiAccess()
    {
        return $this->container['allow_public_api_access'];
    }

    /**
     * Sets allow_public_api_access
     *
     * @param bool|null $allow_public_api_access Specifies whether the table can be read by public without authorization
     *
     * @return self
     */
    public function setAllowPublicApiAccess($allow_public_api_access)
    {
        $this->container['allow_public_api_access'] = $allow_public_api_access;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return \DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param \DateTime|null $created_at Timestamp at which the table is created
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets published_at
     *
     * @return \DateTime|null
     */
    public function getPublishedAt()
    {
        return $this->container['published_at'];
    }

    /**
     * Sets published_at
     *
     * @param \DateTime|null $published_at Timestamp at which the table is published recently
     *
     * @return self
     */
    public function setPublishedAt($published_at)
    {
        $this->container['published_at'] = $published_at;

        return $this;
    }

    /**
     * Gets updated_at
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->container['updated_at'];
    }

    /**
     * Sets updated_at
     *
     * @param \DateTime|null $updated_at Timestamp at which the table is updated recently
     *
     * @return self
     */
    public function setUpdatedAt($updated_at)
    {
        $this->container['updated_at'] = $updated_at;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


