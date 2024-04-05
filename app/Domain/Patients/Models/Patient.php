<?php

namespace App\Domain\Patients\Models;

use App\Domain\Admissions\Models\Admission;
use App\Domain\Agents\Models\Agent;
use App\Domain\Epidemiologics\Models\Epidemiologic;
use App\Domain\Files\Models\File;
use App\Domain\MKB\Models\MKB;
use App\Domain\Payments\Models\Payment;
use App\Domain\UserPatients\Models\UserPatient;
use App\Models\Traits\Filterable;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $agent_id
 * @property string $full_name
 * @property string|null $workplace ish joyi
 * @property string $birthday
 * @property array $province_city viloyat, shahar
 * @property string $address
 * @property string|null $job
 * @property string|null $phone
 * @property string|null $description
 * @property string|null $avatar
 * @property string|null $avatar_path
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Agent $agent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Epidemiologic> $epidemiologics
 * @property-read int|null $epidemiologics_count
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAvatarPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereProvinceCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereWorkplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient filter(\App\Filters\FilterInterface $filter)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @mixin \Eloquent
 */
class Patient extends Model
{
    use HasFactory, Filterable;

    protected $with = ['agent', 'epidemiologics','payments','admissions'];

    protected $casts = [
        'province_city' => 'json'
    ];

    protected $perPage = 20;

    /**
     * @return BelongsTo
     */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /**
     * @return BelongsToMany
     */
    public function epidemiologics(): BelongsToMany
    {
        return $this->belongsToMany(Epidemiologic::class, 'patient_epidemiologics');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_patients');
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class)->without(['patient'])->without('user_patients');
    }

    /**
     * @return HasMany
     */
    public function admissions(): HasMany
    {
        return $this->hasMany(Admission::class,'patient_id','id');
    }
}
