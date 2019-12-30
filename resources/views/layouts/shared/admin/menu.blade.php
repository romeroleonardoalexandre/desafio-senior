<!-- BEGIN: SideNav-->
<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('home') }}"><span class="logo-text hide-on-med-and-down">{{ config('app.name') }}</span></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="bold {{ (request()->segment(2) == 'produtos') ? 'active' : '' }}"><a class="waves-effect waves-cyan  {{ (request()->segment(2) == 'produtos') && request()->segment(3) == sha1(5) ? 'active' : '' }}" href="{{ route('admin.produtos.index') }}"><i class="material-icons">home</i><span class="menu-title" data-i18n="">{{ __('Produtos') }}</span></a></li>
        <li class="bold {{ (request()->segment(2) == 'home') ? 'active' : '' }}"><a class="waves-effect waves-cyan  {{ (request()->segment(2) == 'home') && request()->segment(3) == sha1(5) ? 'active' : '' }}" href="{{ route('admin.vendas.index') }}"><i class="material-icons">list</i><span class="menu-title" data-i18n="">{{ __('Vendas') }}</span></a></li>
    </ul>
    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->
