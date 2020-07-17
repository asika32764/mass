{{-- Part of Admin project. --}}
<?php
/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app           \Windwalker\Web\Application                 Global Application
 * @var $package       \Windwalker\Core\Package\AbstractPackage    Package object.
 * @var $view          \Admin\View\Sakuras\SakurasHtmlView  View object.
 * @var $uri           \Windwalker\Uri\UriData                     Uri information, example: $uri->path
 * @var $chronos       \Windwalker\Core\DateTime\DateTime          PHP DateTime object of current time.
 * @var $helper        \Windwalker\Core\View\Helper\Set\HelperSet  The Windwalker HelperSet object.
 * @var $router        \Windwalker\Core\Router\MainRouter          Route builder object.
 * @var $asset         \Windwalker\Core\Asset\AssetManager         The Asset manager.
 *
 * View variables
 * --------------------------------------------------------------
 * @var $filterBar     \Windwalker\Core\Widget\Widget
 * @var $filterForm    \Windwalker\Form\Form
 * @var $batchForm     \Windwalker\Form\Form
 * @var $showFilterBar boolean
 * @var $grid          \Phoenix\View\Helper\GridHelper
 * @var $state         \Windwalker\Structure\Structure
 * @var $items         \Windwalker\Data\DataSet|\Admin\Record\SakuraRecord[]
 * @var $item          \Admin\Record\SakuraRecord
 * @var $i             integer
 * @var $pagination    \Windwalker\Core\Pagination\Pagination
 */

$url = new \Windwalker\Uri\Uri($uri->full);
$url->delVar('page');
?>

@extends('_global.admin.pure')

@section('toolbar')
    @include('toolbar')
@stop

@push('script')
    {{-- Add Script Here --}}
@endpush

@section('body')
    <div id="phoenix-admin" class="sakuras-container grid-container">
        <form name="admin-form" id="admin-form" action="{{ $url }}" method="POST" enctype="multipart/form-data">

            {{-- FILTER BAR --}}
            <div class="filter-bar">
                {!! $filterBar->render(['form' => $form, 'show' => $showFilterBar]) !!}
            </div>

            {{-- RESPONSIVE TABLE DESC --}}
            <p class="visible-xs-block d-sm-block d-md-none">
                @lang('phoenix.grid.responsive.table.desc')
            </p>

            <div class="grid-table">
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        {{-- TITLE --}}
                        <th class="text-nowrap">
                            {!! $grid->sortTitle('mass.sakura.field.title', 'sakura.title') !!}
                        </th>

                        {{-- STATE --}}
                        <th width="5%" class="text-nowrap">
                            {!! $grid->sortTitle('mass.sakura.field.state', 'sakura.state') !!}
                        </th>

                        {{-- CREATED --}}
                        <th width="15%" class="text-nowrap">
                            {!! $grid->sortTitle('mass.sakura.field.created', 'sakura.created') !!}
                        </th>

                        {{-- ID --}}
                        <th width="5%" class="text-nowrap">
                            {!! $grid->sortTitle('mass.sakura.field.id', 'sakura.id') !!}
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($items as $i => $item)
                        <?php
                        $grid->setItem($item, $i);
                        ?>
                        <tr>
                            {{-- CHECKBOX --}}
                            <td>
                                <a href="#"
                                    onclick="parent.{{ $function }}('{{ $selector }}', { value: '{{ $item->id }}', title: '{{ $item->title }}', image: '{{ $item->image }}' });">
                                    <span class="fa fa-angle-right text-muted"></span> {{ $item->title }}
                                </a>
                            </td>

                            {{-- STATE --}}
                            <td class="text-center">
                                {!! $grid->published($item->state, ['only_icon' => true]) !!}
                            </td>

                            {{-- CREATED --}}
                            <td>
                                {{ \Windwalker\Core\DateTime\Chronos::toLocalTime($item->created, 'Y-m-d') }}
                            </td>

                            {{-- ID --}}
                            <td class="text-right">
                                {{ $item->id }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        {{-- PAGINATION --}}
                        <td colspan="25">
                            {!! $pagination->render() !!}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="hidden-inputs">
                {{-- METHOD --}}
                <input type="hidden" name="_method" value="PUT" />

                {{-- TOKEN --}}
                @formToken
            </div>
        </form>
    </div>
@stop
