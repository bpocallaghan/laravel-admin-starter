<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ profile_image() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! user()->firstname !!}</p>
                <p>{!! user()->lastname !!}</p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <nav>
            {!! $navigation !!}
        </nav>
    </section>
</aside>