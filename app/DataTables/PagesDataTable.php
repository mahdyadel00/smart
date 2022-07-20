<?php

namespace App\DataTables;

use App\Bll\Lang;
use App\Bll\Utility;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\Models\SitePages\Page;

class PagesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)

            ->editColumn('published', function($query) {
                return $query->published == 1 ? _i('Published') : _i('Not Published');
            })
            ->addColumn('edit', function($query){
                $html = '';
                // if(Auth::user()->hsaPermissionTo('Update_page')){

                    $html = '<a href="#" data-toggle="modal" data-target="#get_link" data-link="'.url('/page/' . $query->id).'" class="btn btn-default get_link"  title="' . _i("Show Link") . '">
                    <i class="ti-link"></i></a>  &nbsp;'.' ';
                // }
                if(Auth::user()->hasPermissionTo('Update_page')){

                    $html = '<a href="'. url('admin/pages/'.$query->id.'/edit') .'" data-toggle="modal" data-target="#modal-edit" data-image="'.$query->image.'" data-place="'.$query->place.'" data-id="'.$query->id.'" data-published="'.$query->published.'" id="item_id_' . $query->id . '" class="btn btn-primary edit"  title="' . _i("Edit") . '">
                    <i class="ti-pencil-alt"></i></a>  &nbsp;'.'
                    </div>';
                }
                if ($query->undeletable != 1){
                    $html .= '<form class=" delete"  action="'.url("admin/pages/".$query->id) .'"  method="POST" id="deleteRow"
                   style="display: inline-block; right: 50px;" >
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger" title=" '._i('Delete').' "> <span> <i class="ti-trash"></i></span></button>
                    </form>';
                }
                if(Auth::user()->hasPermissionTo('Lang_page')){


                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$query->id.'" data-lang="'.$lang->id.'" style="display: block; padding: 5px 10px 10px;">'.$lang->title.'</a></li>';
                }
                $html = $html.'
                <div class="btn-group">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" '._i('Translation').' ">
                    <span class="ti ti-settings"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                    '.$options.'
                  </ul>
                </div> ';
                $html .= '<a href="'.url('admin/pages/'.$query->id.'/edit').'" class="btn btn-success mx-2">'._i('Edit Page').'</a>';
            }
                return $html;
            })

            //->addColumn('delete', 'admin.articles.article.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'show',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query( )
    {
        return Page::leftJoin('site_pages_data' ,'site_pages_data.page_id','site_pages.id')
            ->select('site_pages.*','site_pages_data.page_id','site_pages_data.lang_id','site_pages_data.source_id',
                'site_pages_data.title','site_pages_data.content')->where('site_pages_data.lang_id' , Lang::getSelectedLangId())->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,_i('all record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="ti-plus"></i> '._i('Add Page').' ',
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                        window.location = "'.url('admin/pages/create').'";}',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="ti-printer"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . _i('admin.EXCEL')],
                ],
                "initComplete" => "function () {
                                  this.api().columns([]).every(function () {
                                       var column = this;
                                       var input = document.createElement(\"input\");
                                       $(input).appendTo($(column.footer()).empty())
                                       .on('keyup', function () {
                                       var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                       column.search(val ? val : '', true, false).draw();
                                  });
                                                  });
                }",
//                "language" =>  self::lang(),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'id','data'=>'id','title'=>_i('ID')],
            ['name'=>'title','data'=>'title','title'=>_i('Title')],
            ['name'=>'published','data'=>'published','title'=>_i('Published')],
            ['name'=>'edit','data'=>'edit','title'=>_i('Controll'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pages_' . date('YmdHis');
    }
}
