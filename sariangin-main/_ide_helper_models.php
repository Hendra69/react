<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Contract
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property int|null $delivery_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ContractCustomer|null $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContractTank[] $tanks
 * @property-read int|null $tanks_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedAt($value)
 */
	class Contract extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContractCustomer
 *
 * @property int $id
 * @property int $contract_id
 * @property int|null $customer_id
 * @property string $type
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\Customer|null $customer
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractCustomer whereUpdatedAt($value)
 */
	class ContractCustomer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContractTank
 *
 * @property int $id
 * @property int $contract_id
 * @property string $contract_type
 * @property int|null $tank_id
 * @property string $category_name
 * @property string $serial_number
 * @property string $status
 * @property string $location
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\Tank|null $tank
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereContractType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereTankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractTank whereUpdatedAt($value)
 */
	class ContractTank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Customer getSelectOptions($labelName = 'label', $valueName = 'value')
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer withFilter($filters = [])
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Delivery
 *
 * @property int $id
 * @property string $date
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DeliveryCustomer|null $customer
 * @property-read \App\Models\DeliveryDriver|null $driver
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryNote[] $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryTankCategory[] $tankCategories
 * @property-read int|null $tank_categories_count
 * @property-read \App\Models\DeliveryVehicle|null $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereUpdatedAt($value)
 */
	class Delivery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryCustomer
 *
 * @property int $id
 * @property int $delivery_id
 * @property int|null $customer_id
 * @property string $type
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\Delivery $delivery
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryCustomer whereUpdatedAt($value)
 */
	class DeliveryCustomer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryDriver
 *
 * @property int $id
 * @property int $delivery_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Delivery $delivery
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryDriver whereUserId($value)
 */
	class DeliveryDriver extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryNote
 *
 * @property int $id
 * @property int $delivery_id
 * @property int|null $user_id
 * @property string $user_name
 * @property string $user_role
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Delivery $delivery
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryNote whereUserRole($value)
 */
	class DeliveryNote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryTank
 *
 * @property int $id
 * @property int $delivery_tank_category_id
 * @property int|null $tank_id
 * @property string $category_name
 * @property string $serial_number
 * @property string $status
 * @property string $location
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tank|null $tank
 * @property-read \App\Models\DeliveryTankCategory $tankCategory
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereDeliveryTankCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereTankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTank whereUpdatedAt($value)
 */
	class DeliveryTank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryTankCategory
 *
 * @property int $id
 * @property int $delivery_id
 * @property int|null $tank_category_id
 * @property string $name
 * @property string $size
 * @property string|null $note
 * @property int $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Delivery $delivery
 * @property-read \App\Models\TankCategory|null $tankCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeliveryTank[] $tanks
 * @property-read int|null $tanks_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereTankCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryTankCategory whereUpdatedAt($value)
 */
	class DeliveryTankCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DeliveryVehicle
 *
 * @property int $id
 * @property int $delivery_id
 * @property int|null $vehicle_id
 * @property string $type
 * @property string $license_plate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Delivery $delivery
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle whereLicensePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryVehicle whereVehicleId($value)
 */
	class DeliveryVehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invoice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 */
	class Invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Price
 *
 * @property int $id
 * @property int $tank_category_id
 * @property string $customer_type
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TankCategory $tankCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereTankCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereUpdatedAt($value)
 */
	class Price extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tank
 *
 * @property int $id
 * @property int|null $tank_category_id
 * @property string $category_name
 * @property string $serial_number
 * @property string $status
 * @property string $location
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TankCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|Tank getSelectOptions($labelName = 'label', $valueName = 'value')
 * @method static \Illuminate\Database\Eloquent\Builder|Tank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereTankCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tank whereUpdatedAt($value)
 */
	class Tank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TankCategory
 *
 * @property int $id
 * @property string $name
 * @property string $size
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tank[] $tanks
 * @property-read int|null $tanks_count
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory getSelectOptions($labelName = 'label', $valueName = 'value')
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TankCategory whereUpdatedAt($value)
 */
	class TankCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $phone
 * @property string $password
 * @property string|null $avatar_path
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $avatar_url
 * @property-read mixed|null $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User getSelectOptions($labelName = 'label', $valueName = 'value')
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string $type
 * @property string $license_plate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VehiclePhoto[] $photos
 * @property-read int|null $photos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle getSelectOptions($labelName = 'label', $valueName = 'value')
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLicensePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUpdatedAt($value)
 */
	class Vehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VehiclePhoto
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string $photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $url
 * @property-read \App\Models\Vehicle $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehiclePhoto whereVehicleId($value)
 */
	class VehiclePhoto extends \Eloquent {}
}

