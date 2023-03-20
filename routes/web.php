<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicalPersonelController;

Route::group(['domain' => ''], function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'do_login'])->name('auth.login');

    Route::middleware('auth')->group(function () {

        // DASHBOARD
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/get-patient', [DashboardController::class, 'getPatient'])->name('dashboard.patient');
        Route::get('dashboard/get-medicine', [DashboardController::class, 'getMedicine'])->name('dashboard.medicine');

        // DATA OBAT
        Route::post('medicine/pdf', [MedicineController::class, 'pdf'])->name('medicine.pdf');
        Route::post('medicine/excel', [MedicineController::class, 'excel'])->name('medicine.excel');
        Route::post('medicine/{medicine}/input_modal', [MedicineController::class, 'input_modal'])->name('medicine.input_modal');
        Route::patch('medicine/{medicine}/update_modal', [MedicineController::class, 'update_modal'])->name('medicine.update_modal');
        Route::post('medicine/input_export_pdf', [MedicineController::class, 'input_export_pdf'])->name('medicine.input_export_pdf');
        Route::post('medicine/input_export_excel', [MedicineController::class, 'input_export_excel'])->name('medicine.input_export_excel');
        Route::patch('medicine/{medicine}', [MedicineController::class, 'update_stock'])->name('medicine.update_stock');
        Route::delete('medicine/{medicine}', [MedicineController::class, 'destroy'])->name('medicine.destroy');
        Route::post('medicine/delete_all', [MedicineController::class, 'delete_all'])->name('medicine.delete_all');
        Route::resource('medicine', MedicineController::class);

        // DATA PASIEN
        Route::get('patient', [PatientController::class, 'index'])->name('patient.index');
        Route::get('patient/create', [PatientController::class, 'create'])->name('patient.create');
        Route::post('patient', [PatientController::class, 'store'])->name('patient.store');
        Route::get('patient/{patient}/show', [PatientController::class, 'show'])->name('patient.show');
        Route::get('patient/{patient}/edit', [PatientController::class, 'edit'])->name('patient.edit');
        Route::patch('patient/{patient}', [PatientController::class, 'update'])->name('patient.update');
        Route::delete('patient/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');
        Route::post('patient/export', [PatientController::class, 'export'])->name('patient.export');
        Route::post('patient/excel', [PatientController::class, 'excel'])->name('patient.excel');
        Route::get('patient/{patient}/pdf', [PatientController::class, 'pdf'])->name('patient.pdf');
        Route::get('patient/{patient}/medical_record', [MedicalRecordController::class, 'index'])->name('patient.medical_record');
        Route::get('patient/{patient}/medical_record/create', [MedicalRecordController::class, 'create'])->name('patient.medical_record.create');
        Route::post('patient/{patient}/medical_record', [MedicalRecordController::class, 'store'])->name('patient.medical_record.store');
        Route::get('patient/{patient}/medical_record/{medical_record}/show', [MedicalRecordController::class, 'show'])->name('patient.medical_record.show');
        Route::get('patient/{patient}/medical_record/{medical_record}/edit', [MedicalRecordController::class, 'edit'])->name('patient.medical_record.edit');
        Route::patch('patient/{patient}/medical_record/{medical_record}', [MedicalRecordController::class, 'update'])->name('patient.medical_record.update');
        Route::delete('patient/{patient}/medical_record/{medical_record}', [MedicalRecordController::class, 'destroy'])->name('patient.medical_record.destroy');
        Route::get('patient/{patient}/medical_record/{medical_record}/pdf', [MedicalRecordController::class, 'pdf'])->name('patient.medical_record.pdf');


        // TENAGA MEDIS
        Route::resource('medicalPersonel', MedicalPersonelController::class);

        Route::post('regional/province', [RegionalController::class, 'province'])->name('regional.province');
        Route::post('regional/city', [RegionalController::class, 'city'])->name('regional.city');
        Route::post('regional/subdistrict', [RegionalController::class, 'subdistrict'])->name('regional.subdistrict');

        // PROFILE
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('', [ProfileController::class, 'index'])->name('index');
            Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
            Route::post('cpassword', [ProfileController::class, 'cpassword'])->name('cpassword');
            Route::post('save', [ProfileController::class, 'save'])->name('save');
        });
        Route::get('counter_notif', [NotificationController::class, 'counter'])->name('counter_notif');
        Route::get('notification', [NotificationController::class, 'index'])->name('notification');
        Route::get('logout', [AuthController::class, 'do_logout'])->name('auth.logout');

        Route::get('migrate', function () {
            Artisan::call('migrate');
            return response()->json([
                'alert' => 'success',
                'message' => 'DB Migrate!'
            ]);
        })->name('db.migrate');
        Route::get('storage-link', function () {
            Artisan::call('storage:link');
            return response()->json([
                'alert' => 'success',
                'message' => 'Storage Linked!'
            ]);
        })->name('storage.link');
        Route::get('db-seed', function () {
            Artisan::call('db:seed');
            return response()->json([
                'alert' => 'success',
                'message' => 'DB Seed!'
            ]);
        })->name('db.seed');
    });
});
