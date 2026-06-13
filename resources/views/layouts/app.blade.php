<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Call Record Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('call-records.index') }}">
            <i class="bi bi-telephone-fill me-2"></i>CRM
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('call-records.*') ? 'active' : '' }}"
                       href="{{ route('call-records.index') }}">
                        <i class="bi bi-file-earmark-text me-1"></i>Call Records
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('confirmation-records.*') ? 'active' : '' }}"
                       href="{{ route('confirmation-records.index') }}">
                        <i class="bi bi-check-circle me-1"></i>Confirmation Records
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('confirmation-record-invalids.*') ? 'active' : '' }}"
                       href="{{ route('confirmation-record-invalids.index') }}">
                        <i class="bi bi-x-circle me-1"></i>Invalid Confirmation Records
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="@yield('container-class', 'container-fluid') mt-4">
    @yield('content')
</div>

<!-- Delete confirmation form (hidden) -->
<form id="delete-form" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
        $('.btn-delete').on('click', function () {
            if (confirm('Are you sure you want to delete this record?')) {
                var action = $(this).data('action');
                $('#delete-form').attr('action', action).submit();
            }
        });
    });
</script>
@yield('scripts')

</body>
</html>
