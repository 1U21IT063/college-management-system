# QUICK REFERENCE - College Management System

## 🚀 Common Commands

```bash
# Start development server
php artisan serve

# Run migrations
php artisan migrate

# Create new migration
php artisan make:migration migration_name

# Clear all caches
php artisan cache:clear && php artisan config:clear && php artisan route:clear

# Optimize for production
php artisan optimize

# Run tests
php artisan test

# Create new controller
php artisan make:controller ControllerName

# Create new model
php artisan make:model ModelName -mcr

# Create new policy
php artisan make:policy PolicyName

# Create new service
php artisan make:service ServiceName

# Create form request
php artisan make:request RequestName

# Generate app key
php artisan key:generate
```

---

## 📁 Project Structure

```
collegemanagement/
├── app/
│   ├── Models/
│   │   ├── User.php (updated)
│   │   ├── Student.php
│   │   ├── Staff.php
│   │   ├── Department.php
│   │   ├── Course.php
│   │   ├── Fee.php
│   │   ├── Mark.php
│   │   └── Attendance.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── StudentController.php
│   │   │   ├── StaffController.php
│   │   │   ├── CourseController.php
│   │   │   ├── DepartmentController.php
│   │   │   ├── FeeController.php
│   │   │   ├── MarkController.php
│   │   │   ├── AttendanceController.php
│   │   │   └── DashboardController.php
│   │   ├── Middleware/
│   │   │   └── CheckRole.php (new)
│   │   └── Requests/
│   │       ├── StoreStudentRequest.php
│   │       ├── UpdateStudentRequest.php
│   │       ├── ... (13 total)
│   ├── Policies/
│   │   ├── StudentPolicy.php
│   │   ├── StaffPolicy.php
│   │   ├── CoursePolicy.php
│   │   ├── DepartmentPolicy.php
│   │   ├── FeePolicy.php
│   │   └── MarkPolicy.php
│   ├── Services/
│   │   ├── StudentService.php
│   │   ├── FeeService.php
│   │   ├── MarkService.php
│   │   └── AttendanceService.php
│   └── Providers/
│       └── AuthServiceProvider.php (updated)
├── routes/
│   └── web.php (updated)
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_add_foreign_keys.php
│   │   └── 2024_01_01_000002_add_soft_deletes_and_indices.php
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php (updated)
│       ├── components/
│       │   ├── alerts.blade.php
│       │   ├── form-errors.blade.php
│       │   ├── delete-modal.blade.php
│       │   └── breadcrumbs.blade.php
│       ├── dashboard.blade.php
│       ├── students/
│       ├── staff/
│       ├── courses/
│       ├── departments/
│       ├── fees/
│       ├── marks/
│       └── attendance/
├── IMPROVEMENTS_ANALYSIS.md
├── IMPLEMENTATION_GUIDE.md
└── COMPLETE_IMPROVEMENTS_SUMMARY.md
```

---

## 🔐 User Roles

```
Admin:
- Manage all students, staff, courses, departments
- View all reports and analytics
- System configuration
- User role assignment

Staff:
- View students and courses
- Mark attendance
- Enter marks
- Manage fees
- View reports (limited to their department)

Student:
- View own profile
- View own marks
- View own fees
- View own attendance
- Cannot modify data
```

---

## 🛣️ API Routes

### RESTful Resource Routes

```php
// Students
Route::resource('students', StudentController::class);
// GET    /students               - index
// GET    /students/create        - create
// POST   /students               - store
// GET    /students/{student}     - show
// GET    /students/{student}/edit - edit
// PUT    /students/{student}     - update
// DELETE /students/{student}     - destroy

// Staff
Route::resource('staff', StaffController::class);

// Courses
Route::resource('courses', CourseController::class);

// Departments
Route::resource('departments', DepartmentController::class);

// Fees
Route::resource('fees', FeeController::class);

// Marks
Route::resource('marks', MarkController::class);

// Attendance
Route::resource('attendance', AttendanceController::class)->only(['index', 'store']);

// PDF Export
Route::get('students/export/pdf', [StudentController::class, 'exportPdf']);
Route::get('fees/export/pdf', [FeeController::class, 'exportPdf']);
Route::get('marks/export/pdf', [MarkController::class, 'exportPdf']);

// Student specific routes
Route::get('my-profile', [StudentController::class, 'profile']);
Route::get('my-marks', [MarkController::class, 'studentMarks']);
Route::get('my-fees', [FeeController::class, 'studentFees']);
Route::get('my-attendance', [AttendanceController::class, 'studentAttendance']);
```

---

## 📝 Validation Rules

### Student Validation
```php
'name' => 'required|string|max:255',
'email' => 'required|email|max:255|unique:students,email',
'phone' => 'required|string|max:20|regex:/^[0-9\+\-\s\(\)]+$/',
'department_id' => 'required|integer|exists:departments,id',
'year' => 'required|integer|min:1|max:4',
'registration_number' => 'nullable|string|max:50|unique:students,registration_number',
'enrollment_date' => 'nullable|date|before_or_equal:today',
```

### Fee Validation
```php
'student_id' => 'required|integer|exists:students,id',
'total_fee' => 'required|numeric|min:0|decimal:0,2',
'paid_fee' => 'required|numeric|min:0|decimal:0,2',
'payment_date' => 'required|date|before_or_equal:today',
'description' => 'nullable|string|max:500',
```

### Mark Validation
```php
'student_id' => 'required|integer|exists:students,id',
'subject' => 'required|string|max:100',
'internal_mark' => 'required|numeric|min:0|max:50',
'external_mark' => 'required|numeric|min:0|max:50',
```

---

## 🔍 Commonly Used Queries

```php
// Get student with all relationships
$student = Student::with(['department', 'fees', 'marks', 'attendances'])->find($id);

// Get fees by status
$fees = Fee::where('status', 'pending')->with('student')->get();

// Get students with low fees
$lowFees = Student::whereHas('fees', function ($q) {
    $q->where('status', 'pending');
})->get();

// Get top performers
$top = Mark::selectRaw('student_id, avg(total_mark) as avg')
    ->groupBy('student_id')
    ->orderByDesc('avg')
    ->limit(10)
    ->with('student')
    ->get();

// Get attendance percentage for student
$percentage = $student->attendances()
    ->where('status', 'present')
    ->count() / $student->attendances()->count() * 100;

// Search students
$students = Student::where('name', 'LIKE', "%$search%")
    ->orWhere('email', 'LIKE', "%$search%")
    ->paginate(15);
```

---

## 🎨 Blade Template Examples

### Showing Alerts
```blade
@include('components.alerts')
```

### Form with Validation
```blade
<form action="{{ route('students.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="name" class="form-label">Name *</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" 
               name="name" value="{{ old('name') }}">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
</form>
```

### Delete Button with Modal
```blade
<button class="btn btn-danger" data-bs-toggle="modal" 
        data-bs-target="#deleteModal{{ $id }}">Delete</button>

@include('components.delete-modal', [
    'id' => 'deleteModal' . $id,
    'message' => 'Are you sure?',
    'action' => route('students.destroy', $student)
])
```

### Pagination Links
```blade
<div class="d-flex justify-content-center">
    {{ $items->links() }}
</div>
```

### Status Badge
```blade
<span class="badge bg-{{ $fee->status_badge }}">{{ ucfirst($fee->status) }}</span>
```

---

## 🔐 Authorization Examples

### In Controller
```php
public function edit(Student $student)
{
    $this->authorize('update', $student);
    // ...
}
```

### In Blade View
```blade
@can('update', $student)
    <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Edit</a>
@endcan

@if(auth()->user()->isAdmin())
    <!-- Admin only content -->
@endif
```

---

## 📊 Service Usage Examples

### StudentService
```php
$service = new StudentService();

// Get student profile
$profile = $service->getStudentProfile($student);

// Search students
$results = $service->searchStudents('John', 15);

// Get low attendance
$low = $service->getStudentsWithLowAttendance(75);
```

### FeeService
```php
$service = new FeeService();

// Calculate balance
$data = $service->calculateBalance([
    'total_fee' => 50000,
    'paid_fee' => 30000
]);

// Get summary
$summary = $service->getStudentFeeSummary($student);

// Get report
$report = $service->getFeeReport([
    'status' => 'pending',
    'start_date' => '2024-01-01'
]);
```

---

## 🧪 Testing Examples

```bash
# Test student creation
php artisan tinker
>>> $student = Student::factory()->create();

# Test relationships
>>> $student->department()->first();
>>> $student->fees()->get();

# Test service
>>> $service = new \App\Services\StudentService();
>>> $service->searchStudents('John');

# Test authorization
>>> auth()->loginUsingId(1);
>>> auth()->user()->can('update', $student);
```

---

## 🐛 Debugging Tips

```php
// Log to file
\Log::info('Debug message', ['data' => $value]);

// Using dd() to dump and die
dd($variable);

// Using dump() to dump
dump($variable);

// Query debugging
\DB::enableQueryLog();
$results = Student::all();
\Log::info(\DB::getQueryLog());

// Check middleware is applied
Route::list();

// Check authorization
auth()->user()->can('view', $student);

// Check relationships are loading
$student->load('department', 'fees');
```

---

## 📋 Checklist for New Features

When adding a new feature (e.g., new model):

- [ ] Create Model with relationships
- [ ] Create Migration with foreign keys
- [ ] Create Form Requests (Store & Update)
- [ ] Create Controller (CRUD methods)
- [ ] Create Policy (authorization)
- [ ] Add routes to web.php
- [ ] Create views (index, create, edit, show)
- [ ] Add service class (if complex logic)
- [ ] Add tests
- [ ] Update documentation
- [ ] Test authorization
- [ ] Test validation

---

## 🚨 Error Handling

### Common Errors & Solutions

**"Route not found"**
```bash
php artisan route:clear
php artisan route:cache
```

**"Class not found"**
```bash
composer dump-autoload
```

**"SQLSTATE error"**
```bash
# Check migrations
php artisan migrate:status

# Rollback and re-run
php artisan migrate:rollback
php artisan migrate
```

**"Authorization denied"**
- Check user role in database
- Verify policy is registered
- Check $this->authorize() call

**"Validation errors"**
- Check Form Request rules
- Verify input field names match
- Check error messages in view

---

## 📚 Documentation Files

- **IMPROVEMENTS_ANALYSIS.md** - Detailed analysis of 10 improvements
- **IMPLEMENTATION_GUIDE.md** - Step-by-step setup guide
- **COMPLETE_IMPROVEMENTS_SUMMARY.md** - Executive summary

---

## 💡 Best Practices

1. **Always use Form Requests for validation**
   - Don't validate in controllers
   - Keep validation rules centralized

2. **Use Route Model Binding**
   ```php
   public function show(Student $student)  // Auto-resolved from route parameter
   ```

3. **Use Authorization Policies**
   ```php
   $this->authorize('update', $student);
   ```

4. **Use Services for Business Logic**
   ```php
   $service = new StudentService();
   $service->searchStudents($query);
   ```

5. **Use Relationships**
   ```php
   $student->fees()->sum('total_fee');  // Not manual queries
   ```

6. **Use Soft Deletes**
   ```php
   $student->delete();  // Soft delete (not permanent)
   $student->restore();  // Restore soft deleted
   ```

7. **Use Pagination**
   ```php
   $students = Student::paginate(15);  // Always paginate large datasets
   ```

8. **Use Scopes for Common Queries**
   ```php
   public function scopeActive($query)
   {
       return $query->whereNull('deleted_at');
   }
   ```

---

## 🔄 Git Workflow

```bash
# Create feature branch
git checkout -b feature/new-feature

# Make changes
# ...

# Commit
git add .
git commit -m "feat: add new feature"

# Push
git push origin feature/new-feature

# Create pull request
# Review and merge
```

---

## 📞 Support Resources

- Laravel Documentation: https://laravel.com/docs
- PHP Documentation: https://www.php.net/docs.php
- MySQL Documentation: https://dev.mysql.com/doc/
- Bootstrap Documentation: https://getbootstrap.com/docs

---

**Last Updated:** May 30, 2026
**Status:** ✅ Production-Ready
**Version:** 1.0.0

