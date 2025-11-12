<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessment_verifications', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('valid_name', 50)->nullable();
            $table->string('code', 15)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('batches', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('batch_name', 30)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('early_bird_end')->nullable();
            $table->enum('batch_status', ['Active', 'Close', 'Open'])->nullable();
            $table->float('disc_early_bird', null, 0)->default(0.05);
            $table->float('admin_fee', null, 0)->default(50000);
            $table->float('discount_referral', null, 0)->default(0);
            $table->integer('referral_limit')->default(3);
            $table->float('merchandise_voucher', null, 0)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('class_dates', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('special_registration_id')->nullable()->index('special_registration_id');
            $table->date('date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('class_sessions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('amount')->nullable();
            $table->integer('program_id')->nullable()->index('class_sessions_ibfk1');
            $table->enum('status', ['Open', 'Close'])->default('Open');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('coach_code', 30)->nullable()->index('coach_code');
            $table->integer('program_id')->nullable()->index('classess_ibfk_2');
            $table->string('start_time', 10)->nullable();
            $table->string('end_time', 10)->nullable();
            $table->string('day', 100)->nullable();
            $table->string('link_wa', 100)->nullable();
            $table->enum('class_status', ['Open', 'Close', 'Pending'])->nullable()->default('Open');
            $table->enum('class_status_eksternal', ['Open', 'Close', 'Pending'])->default('Pending');
            $table->integer('class_session_id')->default(2)->index('classes_ibfk_3');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['id', 'coach_code'], 'classes_index_3');
        });

        Schema::create('coach_certificates', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('coach_code', 30)->nullable()->index('coach_certificates_ibfk_1');
            $table->string('certificate_name', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('coach_skills', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('coach_code', 30)->nullable()->index('coach_skills_index_7');
            $table->string('skill_name', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('coaches', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 30)->nullable()->unique('code');
            $table->string('coach_name', 100)->nullable();
            $table->string('nick_name', 15)->nullable();
            $table->char('gender', 10)->nullable();
            $table->string('birth_place', 50)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('marriage_status', ['Lajang', 'Menikah', 'Janda'])->nullable();
            $table->string('address', 500)->nullable();
            $table->string('mobile_phone', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->integer('body_height')->nullable();
            $table->integer('body_weight')->nullable();
            $table->enum('coach_status', ['Aktif', 'Cuti', 'Mengundurkan Diri', 'Keluar', 'Aktif Kembali'])->nullable();
            $table->enum('coach_status_eksternal', ['Aktif', 'Mengundurkan Diri', 'Cuti', 'Dikeluarkan', 'Pensiun'])->nullable()->default('Aktif');
            $table->enum('type', ['Reguler', 'Workshop'])->default('Reguler');
            $table->string('color_hex', 25)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['id', 'code'], 'coaches_index_2');
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->char('id', 5)->primary();
            $table->string('country_name', 40)->nullable();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->char('id', 20)->primary();
            $table->char('regency_id', 5)->nullable();
            $table->string('district_name', 40)->nullable();

            $table->index(['regency_id', 'id'], 'districts_index_13');
        });

        Schema::create('from_influencer_registrations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('registration_id')->nullable()->index('from_influencer_registrations_index_9');
            $table->integer('influencer_referral_id')->nullable()->index('from_influencer_registrations_index_10');
            $table->integer('influencer_id')->nullable()->index('from_influencer_registrations_index_11');
            $table->integer('batch_id')->nullable()->index('from_influencer_registrations_index_12');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();

            $table->index(['influencer_referral_id', 'batch_id'], 'from_influencer_registrations_index_13');
        });

        Schema::create('influencer_referrals', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('influencer_id')->nullable()->index('influencer_referrals_index_4');
            $table->string('code')->nullable()->index('influencer_referrals_index_5');
            $table->boolean('is_active')->nullable();
            $table->date('expired_date')->nullable();
            $table->integer('used_limit')->nullable();
            $table->double('discount', null, 0)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();

            $table->index(['influencer_id', 'is_active'], 'influencer_referrals_index_6');
            $table->index(['code', 'is_active'], 'influencer_referrals_index_7');
        });

        Schema::create('influencers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable()->index('influencers_index_1');
            $table->string('country_code', 5)->nullable();
            $table->string('phone', 15)->nullable()->index('influencers_index_2');
            $table->string('link_instagram')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable()->default('Aktif');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });

        Schema::create('levels', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('level_name', 30)->nullable();
            $table->integer('grade')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('member_off', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('member_code', 30)->nullable();
            $table->enum('category_off', ['Aktif', 'Cuti', 'Mengundurkan Diri', 'Keluar', 'Aktif Kembali'])->nullable();
            $table->string('reason', 500)->nullable();
            $table->integer('coach_id')->nullable()->index('coach_id');
            $table->integer('program_id')->nullable()->index('program_id');
            $table->integer('class_id')->nullable()->index('class_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['member_code', 'coach_id', 'program_id', 'class_id'], 'member_off_index_5');
        });

        Schema::create('members', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 30)->nullable()->unique('code');
            $table->string('member_name', 50)->nullable();
            $table->char('gender', 10)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('address', 500)->nullable();
            $table->char('country_id', 5)->nullable()->index('country_id');
            $table->char('province_id', 5)->nullable()->index('province_id');
            $table->char('regency_id', 5)->nullable()->index('regency_id');
            $table->char('district_id', 10)->nullable()->index('members_ibfk_4');
            $table->string('mobile_phone', 15)->nullable();
            $table->integer('body_height')->nullable();
            $table->integer('body_weight')->nullable();
            $table->integer('age_start')->nullable();
            $table->string('medical_condition', 250)->nullable();
            $table->string('medical_file', 250)->nullable();
            $table->string('member_type', 100)->nullable()->default('Reeactive');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['code', 'country_id', 'province_id', 'regency_id', 'district_id'], 'members_index_4');
        });

        Schema::create('phone_codes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('country_name', 50)->nullable();
            $table->integer('code')->nullable();
        });

        Schema::create('pricelists', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('program_id')->nullable();
            $table->string('coach_code', 30)->nullable()->index('coach_code');
            $table->integer('price')->nullable();
            $table->integer('price_per_person')->nullable();
            $table->integer('price_renewal')->nullable();
            $table->integer('price_special')->nullable();
            $table->integer('price_session_20')->nullable();
            $table->integer('price_session_27_old')->nullable();
            $table->integer('price_session_27_new')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['program_id', 'coach_code'], 'pricelists_index_6');
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('program_name', 50)->nullable();
            $table->integer('quota_min')->nullable();
            $table->integer('quota_max')->nullable();
            $table->enum('program_status', ['Open', 'Close'])->nullable()->default('Open');
            $table->char('program_type', 50)->nullable()->default('Reguler');
            $table->boolean('is_pregnant_friendly')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('provinces', function (Blueprint $table) {
            $table->char('id', 5)->primary();
            $table->char('country_id', 5)->nullable();
            $table->string('province_name', 40)->nullable();

            $table->index(['country_id', 'id'], 'provinces_index_11');
        });

        Schema::create('referral_registrations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('batch_id')->nullable()->index('batch_id');
            $table->integer('referral_id')->nullable();
            $table->string('member_code', 30)->nullable()->index('ibfk_member_code');
            $table->integer('registration_id')->nullable()->index('ibfk_registration_id');
            $table->date('date')->nullable();
            $table->boolean('is_cashback')->default(false);
            $table->boolean('is_used')->default(true);
            $table->float('discount', null, 0)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('referrals', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('member_code', 30)->index('member_code');
            $table->string('code', 50);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('regencies', function (Blueprint $table) {
            $table->char('id', 5)->primary();
            $table->char('province_id', 5)->nullable();
            $table->string('regency_name', 40)->nullable();

            $table->index(['province_id', 'id'], 'regencies_index_12');
        });

        Schema::create('registrations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('member_code', 30)->nullable();
            $table->integer('batch_id')->nullable()->index('batch_id');
            $table->integer('amount_pay')->nullable();
            $table->float('admin_fee', null, 0)->default(0);
            $table->float('program_price', null, 0)->nullable();
            $table->string('file_upload', 100)->nullable();
            $table->enum('payment_status', ['Process', 'Done', 'Invalid', 'Follow Up'])->nullable();
            $table->string('invalid_reason', 500)->nullable();
            $table->enum('registration_category', ['New Member', 'Renewal Member', 'Come Back'])->nullable();
            $table->enum('registration_type', ['Reguler', 'Early Bird'])->default('Reguler');
            $table->integer('program_id')->nullable()->index('program_id');
            $table->integer('level_id')->nullable()->index('level_id');
            $table->integer('coach_id')->nullable()->index('coach_id');
            $table->integer('class_id')->nullable()->index('class_id');
            $table->string('note', 1000)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['member_code', 'batch_id', 'program_id', 'level_id', 'coach_id', 'class_id'], 'registrations_index_14');
        });

        Schema::create('reset_password', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('member_code', 30);
            $table->string('member_name', 50)->nullable();
            $table->string('program', 50)->nullable();
            $table->string('coach', 50)->nullable();
            $table->string('class', 50)->nullable();
            $table->string('whatsapp', 20);
            $table->string('reset_code', 15)->unique('reset_code');
            $table->enum('reset_status', ['Open', 'Close']);
            $table->boolean('notif');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('role_name', 30)->nullable();
            $table->string('access_grant', 500)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('special_registrations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('member_code', 30)->index('member_code');
            $table->float('amount_pay', null, 0)->default(0);
            $table->float('admin_fee', null, 0)->default(0);
            $table->float('program_price', null, 0)->default(0);
            $table->string('file_upload')->nullable();
            $table->enum('payment_status', ['Process', 'Invalid', 'Done', 'Follow Up'])->default('Process');
            $table->string('invalid_reason', 1000)->nullable();
            $table->integer('program_id')->nullable()->index('program_id');
            $table->integer('coach_id')->nullable()->index('coach_id');
            $table->integer('class_id')->nullable()->index('class_id');
            $table->string('note', 1000)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['coach_id', 'class_id'], 'coach_id_2');
            $table->index(['member_code', 'program_id', 'coach_id', 'class_id'], 'member_code_2');
            $table->index(['program_id', 'coach_id', 'class_id'], 'program_id_2');
            $table->index(['program_id', 'coach_id'], 'program_id_3');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('email', 50)->nullable()->unique('email');
            $table->string('password')->nullable();
            $table->integer('role_id')->nullable()->index('users_index_16');
            $table->string('full_name', 100)->nullable();
            $table->char('gender', 10)->nullable();
            $table->string('photo')->nullable();
            $table->boolean('default_pw')->nullable()->default(true);
            $table->string('type', 50)->default('Reguler');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('voucher_merchandises', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('qr_code', 20)->index('qr_code');
            $table->string('member_code', 50)->index('member_code');
            $table->integer('batch_id')->index('batch_id');
            $table->integer('registration_id')->nullable()->index('registration_id');
            $table->date('valid_date');
            $table->boolean('is_used')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('vouchers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 30)->index('code');
            $table->string('voucher_name', 50)->nullable();
            $table->enum('voucher_status', ['Active', 'Expired']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('workshop_batches', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('batch_name', 50);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('batch_status', ['Open', 'Close', 'Active'])->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('workshop_registrations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('member_code', 50)->nullable()->index('ibfk_1');
            $table->integer('workshop_batch_id')->nullable()->index('workshop_ibfk2');
            $table->integer('amount_pay')->default(0);
            $table->string('file_upload', 100)->nullable();
            $table->enum('payment_status', ['Process', 'Done', 'Invalid'])->default('Process');
            $table->string('invalid_reason', 500)->nullable();
            $table->enum('registration_category', ['Renewal Member', 'New Member', 'Come Back'])->nullable();
            $table->boolean('is_assessment')->default(false);
            $table->integer('program_id')->nullable()->index('workshop_ibfk3');
            $table->integer('coach_id')->nullable()->index('workshop_ibfk4');
            $table->integer('class_id')->nullable()->index('workshop_ibfk5');
            $table->string('voucher_code', 50)->nullable()->index('ibfk_2');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('class_dates', function (Blueprint $table) {
            $table->foreign(['special_registration_id'], 'special_registration_id_ibfk')->references(['id'])->on('special_registrations')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('class_sessions', function (Blueprint $table) {
            $table->foreign(['program_id'], 'class_sessions_ibfk1')->references(['id'])->on('programs')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('classes', function (Blueprint $table) {
            $table->foreign(['class_session_id'], 'classes_ibfk_3')->references(['id'])->on('class_sessions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['program_id'], 'classess_ibfk_2')->references(['id'])->on('programs')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('coach_certificates', function (Blueprint $table) {
            $table->foreign(['coach_code'], 'coach_certificates_ibfk_1')->references(['code'])->on('coaches')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('coach_skills', function (Blueprint $table) {
            $table->foreign(['coach_code'], 'coach_skills_ibfk_1')->references(['code'])->on('coaches')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreign(['regency_id'], 'districts_ibfk_1')->references(['id'])->on('regencies')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('from_influencer_registrations', function (Blueprint $table) {
            $table->foreign(['influencer_referral_id'], 'from_influencer_registrations_ibfk_1')->references(['id'])->on('influencer_referrals')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['influencer_id'], 'from_influencer_registrations_ibfk_2')->references(['id'])->on('influencers')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['registration_id'], 'registration_id_influener')->references(['id'])->on('registrations')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('influencer_referrals', function (Blueprint $table) {
            $table->foreign(['influencer_id'], 'influencer_referrals_ibfk_1')->references(['id'])->on('influencers')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('member_off', function (Blueprint $table) {
            $table->foreign(['member_code'], 'member_off_ibfk_1')->references(['code'])->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['coach_id'], 'member_off_ibfk_2')->references(['id'])->on('coaches')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['program_id'], 'member_off_ibfk_3')->references(['id'])->on('programs')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['class_id'], 'member_off_ibfk_4')->references(['id'])->on('classes')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->foreign(['province_id'], 'members_ibfk_2')->references(['id'])->on('provinces')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['regency_id'], 'members_ibfk_3')->references(['id'])->on('regencies')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['district_id'], 'members_ibfk_5')->references(['id'])->on('districts')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('pricelists', function (Blueprint $table) {
            $table->foreign(['program_id'], 'pricelists_ibfk_1')->references(['id'])->on('programs')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['coach_code'], 'pricelists_ibfk_2')->references(['code'])->on('coaches')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('referral_registrations', function (Blueprint $table) {
            $table->foreign(['batch_id'], 'ibfk_batch_id')->references(['id'])->on('batches')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['member_code'], 'ibfk_member_code')->references(['code'])->on('members')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['registration_id'], 'ibfk_registration_id')->references(['id'])->on('registrations')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('regencies', function (Blueprint $table) {
            $table->foreign(['province_id'], 'regencies_ibfk_1')->references(['id'])->on('provinces')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->foreign(['member_code'], 'registrations_ibfk_1')->references(['code'])->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['batch_id'], 'registrations_ibfk_2')->references(['id'])->on('batches')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['program_id'], 'registrations_ibfk_3')->references(['id'])->on('programs')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['level_id'], 'registrations_ibfk_4')->references(['id'])->on('levels')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['coach_id'], 'registrations_ibfk_5')->references(['id'])->on('coaches')->onUpdate('set null')->onDelete('set null');
            $table->foreign(['class_id'], 'registrations_ibfk_6')->references(['id'])->on('classes')->onUpdate('set null')->onDelete('set null');
        });

        Schema::table('special_registrations', function (Blueprint $table) {
            $table->foreign(['class_id'], 'class_id_ibfk')->references(['id'])->on('classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['coach_id'], 'coach_id_ibfk')->references(['id'])->on('coaches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['member_code'], 'member_code_ibfk')->references(['code'])->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['program_id'], 'program_id_ibfk')->references(['id'])->on('programs')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['role_id'], 'users_ibfk_1')->references(['id'])->on('roles')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('voucher_merchandises', function (Blueprint $table) {
            $table->foreign(['member_code'], 'ibfk_member_code_voucher')->references(['code'])->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['batch_id'], 'voucher_ibfk_batch_id')->references(['id'])->on('batches')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['registration_id'], 'voucher_ibfk_register_id')->references(['id'])->on('registrations')->onUpdate('no action')->onDelete('no action');
        });

        Schema::table('workshop_registrations', function (Blueprint $table) {
            $table->foreign(['member_code'], 'ibfk_1')->references(['code'])->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['workshop_batch_id'], 'workshop_ibfk2')->references(['id'])->on('workshop_batches')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['program_id'], 'workshop_ibfk3')->references(['id'])->on('programs')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['coach_id'], 'workshop_ibfk4')->references(['id'])->on('coaches')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['class_id'], 'workshop_ibfk5')->references(['id'])->on('classes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['voucher_code'], 'workshop_ibfk6')->references(['code'])->on('vouchers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workshop_registrations', function (Blueprint $table) {
            $table->dropForeign('ibfk_1');
            $table->dropForeign('workshop_ibfk2');
            $table->dropForeign('workshop_ibfk3');
            $table->dropForeign('workshop_ibfk4');
            $table->dropForeign('workshop_ibfk5');
            $table->dropForeign('workshop_ibfk6');
        });

        Schema::table('voucher_merchandises', function (Blueprint $table) {
            $table->dropForeign('ibfk_member_code_voucher');
            $table->dropForeign('voucher_ibfk_batch_id');
            $table->dropForeign('voucher_ibfk_register_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_ibfk_1');
        });

        Schema::table('special_registrations', function (Blueprint $table) {
            $table->dropForeign('class_id_ibfk');
            $table->dropForeign('coach_id_ibfk');
            $table->dropForeign('member_code_ibfk');
            $table->dropForeign('program_id_ibfk');
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign('registrations_ibfk_1');
            $table->dropForeign('registrations_ibfk_2');
            $table->dropForeign('registrations_ibfk_3');
            $table->dropForeign('registrations_ibfk_4');
            $table->dropForeign('registrations_ibfk_5');
            $table->dropForeign('registrations_ibfk_6');
        });

        Schema::table('regencies', function (Blueprint $table) {
            $table->dropForeign('regencies_ibfk_1');
        });

        Schema::table('referral_registrations', function (Blueprint $table) {
            $table->dropForeign('ibfk_batch_id');
            $table->dropForeign('ibfk_member_code');
            $table->dropForeign('ibfk_registration_id');
        });

        Schema::table('pricelists', function (Blueprint $table) {
            $table->dropForeign('pricelists_ibfk_1');
            $table->dropForeign('pricelists_ibfk_2');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign('members_ibfk_2');
            $table->dropForeign('members_ibfk_3');
            $table->dropForeign('members_ibfk_5');
        });

        Schema::table('member_off', function (Blueprint $table) {
            $table->dropForeign('member_off_ibfk_1');
            $table->dropForeign('member_off_ibfk_2');
            $table->dropForeign('member_off_ibfk_3');
            $table->dropForeign('member_off_ibfk_4');
        });

        Schema::table('influencer_referrals', function (Blueprint $table) {
            $table->dropForeign('influencer_referrals_ibfk_1');
        });

        Schema::table('from_influencer_registrations', function (Blueprint $table) {
            $table->dropForeign('from_influencer_registrations_ibfk_1');
            $table->dropForeign('from_influencer_registrations_ibfk_2');
            $table->dropForeign('registration_id_influener');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropForeign('districts_ibfk_1');
        });

        Schema::table('coach_skills', function (Blueprint $table) {
            $table->dropForeign('coach_skills_ibfk_1');
        });

        Schema::table('coach_certificates', function (Blueprint $table) {
            $table->dropForeign('coach_certificates_ibfk_1');
        });

        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign('classes_ibfk_1');
            $table->dropForeign('classes_ibfk_3');
            $table->dropForeign('classess_ibfk_2');
        });

        Schema::table('class_sessions', function (Blueprint $table) {
            $table->dropForeign('class_sessions_ibfk1');
        });

        Schema::table('class_dates', function (Blueprint $table) {
            $table->dropForeign('special_registration_id_ibfk');
        });

        Schema::dropIfExists('workshop_registrations');

        Schema::dropIfExists('workshop_batches');

        Schema::dropIfExists('vouchers');

        Schema::dropIfExists('voucher_merchandises');

        Schema::dropIfExists('users');

        Schema::dropIfExists('special_registrations');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('reset_password');

        Schema::dropIfExists('registrations');

        Schema::dropIfExists('regencies');

        Schema::dropIfExists('referrals');

        Schema::dropIfExists('referral_registrations');

        Schema::dropIfExists('provinces');

        Schema::dropIfExists('programs');

        Schema::dropIfExists('pricelists');

        Schema::dropIfExists('phone_codes');

        Schema::dropIfExists('members');

        Schema::dropIfExists('member_off');

        Schema::dropIfExists('levels');

        Schema::dropIfExists('influencers');

        Schema::dropIfExists('influencer_referrals');

        Schema::dropIfExists('from_influencer_registrations');

        Schema::dropIfExists('districts');

        Schema::dropIfExists('countries');

        Schema::dropIfExists('coaches');

        Schema::dropIfExists('coach_skills');

        Schema::dropIfExists('coach_certificates');

        Schema::dropIfExists('classes');

        Schema::dropIfExists('class_sessions');

        Schema::dropIfExists('class_dates');

        Schema::dropIfExists('batches');

        Schema::dropIfExists('assessment_verifications');
    }
};
