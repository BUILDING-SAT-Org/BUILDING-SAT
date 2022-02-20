<?php

namespace App\Http\Controllers;

use App\Models\BsatBuildingForm;
use App\Models\BsatBuildingType;
use App\Models\BsatDifficultyLevel;
use App\Models\BsatDistance;
use App\Models\BsatMainPhase;
use App\Models\BsatSubPhase;
use App\Models\Location;
use App\Models\BsatMaterialCategory;
use App\Models\BsatProjectType;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Throwable;
use App\Traits\UtilTrait;
use DB;

class SQlController extends Controller
{
    use UtilTrait;

    public static function all()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            self::generateCountries();
            self::generateProjectTypes();
            self::generateBuildingTypes();
            self::generateBuildingForms();
            self::generateDistances();

            self::generateMainPhases();
            self::generateSubPhases();
            self::generateDifficultyLevels();

            self::generateMaterialCategories();

            self::createAdminUser();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (Throwable $e) {
            throw new $e;
        }
    }

    public static function getFile(string $filePath)
    {
        if (file_exists($filePath)) {
            return file($filePath);
        } else {
            if (file_exists("../" . $filePath)) {
                return file("../" . $filePath);
            }
        }
        return new FileNotFoundException();
    }

    public static function logToConsole(string $msg): void
    {
        $out = new ConsoleOutput();
        $out->writeln("<comment>" . $msg . "</comment>");
    }

    private static function createAdminUser()
    {
        User::truncate();

        self::logToConsole("Creating Admin User");
        $adminUser = new User();
        $adminUser->name = "BSAT Admin";
        $adminUser->email = env("ADMIN_EMAIL");
        $adminUser->country_id = 0;
        $adminUser->role = env("ADMIN_ROLE");
        $adminUser->user_type = env("ADMIN_ROLE");
        $adminUser->company = "BSAT";
        $adminUser->subscribed_newsletter = env("ADMIN_SUBSCRIBE_NEWSLETTER");
        $adminUser->password = Hash::make(env("ADMIN_PASSWORD"));
        $adminUser->save();

        $subscribe_data_array = [
            'account_name' => $adminUser->name,
            'last_name' => $adminUser->name,
            'service' => 'Newsletter',
            'email' => $adminUser->email,
            'optin_id' => 'optin_id',
            'ip_address' => 'true'
        ];

        if ($adminUser->subscribed_newsletter == 1) {
            $subscribe_data_array = array_merge($subscribe_data_array, [
                'list_id' => 2
            ]);
        }

        $response = Http::get('http://building-sat.com/wp-json/bloom/v1/config');

        $subscribe_nonce = json_decode($response->body())->subscribe_nonce;

        $response = Http::asForm()->post('http://building-sat.com/wp-admin/admin-ajax.php', [
            'subscribe_nonce' => $subscribe_nonce,
            'subscribe_data_array' => json_encode($subscribe_data_array),
            'action' => 'bloom_subscribe',
        ]);
    }

    public static function csv_to_array($filename = '', $delimiter = ',')
    {

        if (!file_exists($filename) || !is_readable($filename)) {
            if (file_exists("../" . $filename) || is_readable("../" . $filename)) {
                $filename = "../" . $filename;
            } else {
                return FALSE;
            }
        }

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }

    public static function generateCountries(): void
    {
        self::logToConsole("Generating Countries");

        Country::truncate();

        $csv = self::csv_to_array('resources/csv/Countries.csv', ';');

        foreach ($csv as $country) {
            try {
                $newCountry = new Country();
                $newCountry->label = trim($country[0]);
                $newCountry->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }

    }

    public static function generateProjectTypes(): void
    {
        self::logToConsole("Generating Project Types");

        BsatProjectType::truncate();
        $arr = self::csv_to_array('resources/csv/ProjectTypes.csv', ';');

        foreach ($arr as $row) {
            try {
                $projectType = new BsatProjectType();
                $projectType->name = trim($row[0]);
                $projectType->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

    public static function generateBuildingTypes(): void
    {
        self::logToConsole("Generating Building Types");

        BsatBuildingType::truncate();
        $arr = self::csv_to_array('resources/csv/BuildingTypes.csv', ';');

        foreach ($arr as $row) {
            try {
                $buildingType = new BsatBuildingType();
                $buildingType->name = trim($row[0]);
                $buildingType->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

    public static function generateBuildingForms(): void
    {
        self::logToConsole("Generating Building Forms");

        BsatBuildingForm::truncate();
        $arr = self::csv_to_array('resources/csv/BuildingForms.csv', ';');

        foreach ($arr as $row) {
            try {
                $buildingForm = new BsatBuildingForm();
                $buildingForm->name = trim($row[0]);
                $buildingForm->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

    public static function generateDifficultyLevels(): void
    {
        self::logToConsole("Generating Difficulty Levels");

        BsatDifficultyLevel::truncate();
        $arr = self::csv_to_array('resources/csv/DifficultyLevels.csv', ';');

        foreach ($arr as $row) {
            try {
                $difficultyLevel = new BsatDifficultyLevel();
                $difficultyLevel->name = trim($row[0]);
                $difficultyLevel->sub_phase_id = trim($row[1]);
                $difficultyLevel->difficulty_factor = trim($row[2]);
                $difficultyLevel->bulking_density = trim($row[3]);
                $difficultyLevel->bulking_factor = trim($row[4]);
                $difficultyLevel->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

    public static function generateMainPhases(): void
    {
        self::logToConsole("Generating Main Phases");

        BsatMainPhase::truncate();
        $arr = self::csv_to_array('resources/csv/MainPhases.csv', ';');

        foreach ($arr as $row) {
            try {
                $mainPhase = new BsatMainPhase();
                $mainPhase->name = trim($row[0]);
                $mainPhase->slug = trim($row[1]);
                $mainPhase->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

    public static function generateSubPhases(): void
    {
        self::logToConsole("Generating Sub Phases");

        BsatSubPhase::truncate();
        $arr = self::csv_to_array('resources/csv/SubPhases.csv', ';');

        foreach ($arr as $row) {
            try {
                $subPhase = new BsatSubPhase();
                $subPhase->main_phase_id = trim($row[0]);
                $subPhase->name = trim($row[1]);
                $subPhase->slug = trim($row[2]);
                $subPhase->contains_materials = trim($row[3]);
                $subPhase->description = trim($row[4]);
                $subPhase->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

    public static function generateDistances(): void
    {
        self::logToConsole("Generating Locations");

        Location::truncate();
        BsatDistance::truncate();
        $csv = array_map('str_getcsv', self::getfile('resources/csv/Distances.csv'));

        $labels_arr = array_slice($csv, 0, 1)[0];
        $labels_arr = array_slice($labels_arr, 1, 69);

        foreach ($labels_arr as $label) {
            try {
                $loc = new Location();
                $loc->label = trim($label);
                $loc->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }

        self::logToConsole("Generating Distances");

        $distances_arr = array_slice($csv, 1, 69);

        $origin_id = 1;
        foreach ($distances_arr as $locs) {
            try {
                $count = 1;
                $locs = array_slice($locs, 1, 69);
                foreach ($locs as $dis) {
                    try {
                        $locc = new BsatDistance();
                        $locc->origin_id = trim($origin_id);
                        $locc->destination_id = trim($count);
                        $locc->distance = trim($dis);
                        $locc->save();
                        $count++;
                    } catch (Throwable $e) {
                        throw new $e;
                    }
                }
                $origin_id++;
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

    public static function generateMaterialCategories(): void
    {
        BsatMaterialCategory::truncate();
        self::logToConsole("Generating Material Categories");

        $arr = self::csv_to_array('resources/csv/MaterialCategories.csv', ';');
        foreach ($arr as $category) {
            try {
                $bsatMaterialCategory = new BsatMaterialCategory();
                $bsatMaterialCategory->label = trim($category[0]);
                $bsatMaterialCategory->is_salvage = trim($category[1]);
                $bsatMaterialCategory->is_replaceable = trim($category[2]);
                $bsatMaterialCategory->save();
            } catch (Throwable $e) {
                throw new $e;
            }
        }
    }

}
