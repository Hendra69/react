<?php

namespace App\Services;

use App\Models\Tank;
use App\Models\TankCategory;
use Intervention\Image\ImageManagerStatic;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class TankService
{
    /**
     * The tank model instance.
     *
     * @var \App\Models\Tank
     */
    protected $tank;

    /**
     * The tank category model instance.
     *
     * @var \App\Models\TankCategory
     */
    protected $tankCategory;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Tank $tank, TankCategory $tankCategory)
    {
        $this->tank = $tank;
        $this->tankCategory = $tankCategory;
    }

    /**
     * Get all tank status.
     * 
     * @return string[]
     */
    public function getTankStatus()
    {
        return $this->tank->getTankStatus();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int[]  $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index($ids = null)
    {
        if ($ids) {
            return $this->tank->whereIn('id', $ids)->get();
        }

        return $this->tank->all();
    }

    /**
     * Get data for dropdowns.
     * 
     * @return array
     */
    public function getDropdowns()
    {
        $dropdowns = [];

        $dropdowns['tankCategories'] = $this->tankCategory->getSelectOptions();
        $dropdowns['tankStatus'] = $this->tank->getTankStatus();

        return $dropdowns;
    }

    /**
     * Get data for filters.
     * 
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        $filters['categories'] = $this->tankCategory->getSelectOptions('text');
        $filters['status'] = $this->tank->getTankStatus('text');
        $filters['locations'] = $this->tank->all()
            ->pluck('location')
            ->unique()
            ->map(fn ($item) => [
                'text' => $item,
                'value' => $item,
            ]);

        return $filters;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\Tank
     */
    public function store($data)
    {
        $tankCategory = $this->tankCategory->findOrFail($data['tank_category_id']);

        $tank = $this->tank->fill([
            'tank_category_id' => $tankCategory->id,
            'category_name' => $tankCategory->name,
            'serial_number' => $data['serial_number'],
            'status' => $data['status'],
            'location' => $data['location'],
            'note' => $data['note'],
        ]);
        $tank->save();

        return $tank;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\Tank  $tank
     * @return \App\Models\Tank
     */
    public function update($data, Tank $tank)
    {
        $tankCategory = $this->tankCategory->findOrFail($data['tank_category_id']);

        $tank->fill([
            'tank_category_id' => $tankCategory->id,
            'category_name' => $tankCategory->name,
            'serial_number' => $data['serial_number'],
            'status' => $data['status'],
            'location' => $data['location'],
            'note' => $data['note'],
        ]);
        $tank->save();

        return $tank;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tank  $tank
     * @return void
     */
    public function destroy(Tank $tank)
    {
        $tank->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->tank->getPaginatedData(
            $params['page'],
            $params['perPage'],
            $params['sortKey'],
            $params['sortOrder'],
            $params['search'],
            [],
            $params['filters']
        );
    }

    /**
     * Generate barcode for a tank by serial number.
     * 
     * @param  \App\Models\Tank  $tank
     * @return \Intervention\Image\Image
     */
    public function generateBarcode(Tank $tank)
    {
        $barcode = DNS1D::getBarcodePNG($tank->serial_number, 'C128', 4, 60);

        $img = ImageManagerStatic::make($barcode);

        $img->resizeCanvas(60, 60, 'center', true);

        $img->text('PT Sari Angin', $img->width() / 2, 15, function ($font) {
            $font->file(public_path('fonts/Manrope-Bold.ttf'));
            $font->size(12);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
        });

        $img->text($tank->serial_number, $img->width() / 2, 105, function ($font) {
            $font->file(public_path('fonts/Manrope-ExtraBold.ttf'));
            $font->size(12);
            $font->color('#000');
            $font->align('center');
            $font->valign('middle');
        });

        $imagick = $img->getCore();

        $blackColor = imagecolorallocate($imagick, 0, 0, 0);

        // deprecated functions, maybe this code will be changed later
        imagedashedline($imagick, 0, 0, $img->width(), 0, $blackColor);
        imagedashedline($imagick, $img->width() - 1, 0, $img->width() - 1, $img->height(), $blackColor);
        imagedashedline($imagick, $img->width(), $img->height() - 1, 0, $img->height() - 1, $blackColor);
        imagedashedline($imagick, 0, $img->height(), 0, 0, $blackColor);

        return $img;
    }

    /**
     * Generate barcode base64 data.
     * 
     * @param  \App\Models\Tank  $tank
     * @return string
     */
    public function generateBarcodeBase64(Tank $tank)
    {
        $image = $this->generateBarcode($tank);

        $encodedImage = $image->encode('png');
        $base64 = 'data:image/png;base64,' . base64_encode($encodedImage);

        return $base64;
    }

    /**
     * Generate barcode base64 data for all tanks.
     * 
     * @param  array  $tanks 
     * @return string[]
     */
    public function generateAllBarcodeBase64($tanks = null)
    {
        if (!$tanks) {
            $tanks = $this->tank->all();
        }

        $images = [];
        foreach ($tanks as $tank) {
            $images[] = $this->generateBarcodeBase64($tank);
        }

        return $images;
    }
}
