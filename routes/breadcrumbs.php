<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Admin
 */

// Dashboard
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('หน้าแรก', route('admin.dashboard.index'));
});

// Change password
Breadcrumbs::for('admin.change-password', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('เปลี่ยนรหัสผ่าน', route('admin.profile.change-password.get'));
});

// User management
Breadcrumbs::for('admin.user', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('จัดการผู้เช่า', route('admin.users.index'));
});
Breadcrumbs::for('admin.user-show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.user');
    $trail->push($user->full_name, route('admin.users.show', $user));
});
Breadcrumbs::for('admin.user-create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.user');
    $trail->push('เพิ่มผู้เช่า', route('admin.users.create'));
});
Breadcrumbs::for('admin.user-edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.user-show', $user);
    $trail->push('แก้ไข', route('admin.users.edit', $user));
});

// Booking under user management
Breadcrumbs::for('admin.booking-create', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.user-show', $user);
    $trail->push('เพิ่มข้อมูลการเช่า', route('admin.users.edit', $user));
});

// ฺBuilding and Room management
Breadcrumbs::for('admin.building', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('อาคารทั้งหมด', route('admin.buildings.index'));
});
Breadcrumbs::for('admin.building-show', function (BreadcrumbTrail $trail, $building) {
    $trail->parent('admin.building');
    $trail->push('อาคาร ' . $building->name, route('admin.buildings.show', $building));
});
Breadcrumbs::for('admin.room-show', function (BreadcrumbTrail $trail, $room) {
    $trail->parent('admin.building-show', $room->floor->building);
    $trail->push('ห้อง ' . $room->floor->building->name,
        route('admin.rooms.show', $room));
});
Breadcrumbs::for('admin.room-edit', function (BreadcrumbTrail $trail, $room) {
    $trail->parent('admin.room-show', $room);
    $trail->push('แก้ไข',
        route('admin.rooms.edit', $room));
});
Breadcrumbs::for('admin.booking-show', function (BreadcrumbTrail $trail, $booking) {
    $trail->parent('admin.room-show', $booking->room);
    $trail->push('รายละเอียดการเช่า #' . $booking->id,
        route('admin.booking.show', $booking));
});
Breadcrumbs::for('admin.booking-edit', function (BreadcrumbTrail $trail, $booking) {
    $trail->parent('admin.booking-show', $booking);
    $trail->push('แก้ไข', route('admin.booking.show', $booking));
});

// Repair management System
Breadcrumbs::for('admin.repair', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('รายการแจ้งซ่อม', route('admin.repairs.index'));
});
Breadcrumbs::for('admin.repair-edit', function (BreadcrumbTrail $trail, $repair) {
    $trail->parent('admin.repair');
    $trail->push('#' . $repair->id, route('admin.repairs.edit', $repair));
});

// Utility Expense management
Breadcrumbs::for('admin.expense', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('รายการจดมิเตอร์', route('admin.expenses.index'));
});
Breadcrumbs::for('admin.expense-create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.expense');
    $trail->push('เพิ่มรายการจดมิเตอร์', route('admin.expenses.create'));
});
Breadcrumbs::for('admin.expense-edit', function (BreadcrumbTrail $trail, $expense) {
    $trail->parent('admin.expense');
    $trail->push('แก้ไขมิเตอร์ ' . $expense->cycle_month, route('admin.expenses.edit', $expense));
});

// Invoice management
Breadcrumbs::for('admin.invoice', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('รายการใบแจ้งหนี้', route('admin.invoices.index'));
});
Breadcrumbs::for('admin.invoice-create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.invoice');
    $trail->push('สร้างใบแจ้งหนี้', route('admin.invoices.create'));
});
Breadcrumbs::for('admin.invoice-show', function (BreadcrumbTrail $trail, $invoice) {
    $trail->parent('admin.invoice');
    $trail->push('#' . $invoice->id, route('admin.invoices.show', $invoice));
});

// Room configuration management
Breadcrumbs::for('admin.configuration', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('รายการตั้งค่าบริการ', route('admin.configurations.index'));
});
Breadcrumbs::for('admin.configuration-create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.configuration');
    $trail->push('เพิ่มราคาห้อง', route('admin.configurations.create'));
});
Breadcrumbs::for('admin.configuration-edit', function (BreadcrumbTrail $trail, $configuration) {
    $trail->parent('admin.configuration');
    $trail->push('แก้ไขราคาห้อง ' . $configuration->name, route('admin.configurations.edit', $configuration));
});

// Summary month report
Breadcrumbs::for('admin.summary-month', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('สรุปยอดประจำเดือน', route('admin.summary.summary-month'));
});
// Summary overdue report
Breadcrumbs::for('admin.summary-overdue', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('สรุปยอดค้างชำระเกินกำหนด', route('admin.summary.summary-overdue'));
});

/**
 * User
 */

// Dashboard
Breadcrumbs::for('user.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('หน้าแรก', route('user.dashboard.index'));
});

// Change password
Breadcrumbs::for('user.change-password', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('เปลี่ยนรหัสผ่าน', route('user.profile.change-password.get'));
});

// Repair
Breadcrumbs::for('user.repair', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('รายการแจ้งซ่อม', route('user.repairs.index'));
});
Breadcrumbs::for('user.repair-create', function (BreadcrumbTrail $trail) {
    $trail->parent('user.repair');
    $trail->push('เพิ่มรายการแจ้งซ่อม', route('user.repairs.create'));
});
Breadcrumbs::for('user.repair-show', function (BreadcrumbTrail $trail, $repair) {
    $trail->parent('user.repair');
    $trail->push('#' . $repair->id, route('user.repairs.show', $repair));
});

// Invoice
Breadcrumbs::for('user.invoice', function (BreadcrumbTrail $trail) {
    $trail->parent('user.dashboard');
    $trail->push('รายการใบแจ้งหนี้', route('user.invoices.index'));
});
Breadcrumbs::for('user.invoice-show', function (BreadcrumbTrail $trail, $invoice) {
    $trail->parent('user.invoice');
    $trail->push('#' . $invoice->id, route('user.invoices.show', $invoice));
});

// View booking
Breadcrumbs::for('user.booking-show', function (BreadcrumbTrail $trail, $booking) {
    $trail->parent('user.dashboard');
    $trail->push('ดูข้อมูลการเช่า #' . $booking->id, route('user.bookings.show', $booking));
});
