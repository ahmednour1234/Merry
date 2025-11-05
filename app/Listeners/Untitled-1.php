<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Treatment_detail;

use Image;

use App\Treatment;

use App\Status_treatment;

use App\Notification;

use App\Comment;

use App\Standards_management;

use App\Treatment_standards_management;

use App\Treatment_save_log;

use Illuminate\Support\Facades\Storage;

use Auth;



class TreatmentDetailController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {


        $treatment = Treatment::findOrFail($request->treatment_id);

        $treatment_id_track = $request->treatment_id;
        $userid_track =  session('id');
        $usertype_track =  session('usertype');
        $status_before_save =  $treatment->status;
        $visit_at =  session('track_treatmet_time');
        $save_at = now();

        $treatment_save_log = new Treatment_save_log;
        $treatment_save_log->treatment_id = $treatment_id_track;
        $treatment_save_log->user_id = auth()->user()->id;
        $treatment_save_log->user_type =  $usertype_track;
        $treatment_save_log->status_before_save = $status_before_save;
        $treatment_save_log->visit_at = $visit_at;
        $treatment_save_log->save_at = $save_at;
        $treatment_save_log->save();
        session(['track_treatmet_time' => $save_at]);

        $validate_array  = ['treatment_id' => 'required', 'template_menus_id' => 'required'];

        $attr_array = [];

        if ($request->submit_completed) {

            foreach ($request->template_menus_id as $template_menus_id_val) {

                $label_name = "label_" . $template_menus_id_val;

                foreach ($request->$label_name as $val) {

                    $fldmndtryname = "field_mendatory_" . $template_menus_id_val . "_" . $val . "";

                    $fldname = "field_" . $template_menus_id_val . "_" . $val . "";

                    $fldfile = "field_file_" . $template_menus_id_val . "_" . $val;

                    if ($request->$fldfile == "yes" && $request->$fldmndtryname == "yes") {

                        $fldname = $fldname . "[]";

                        $validate_array[$fldname] = 'required|mimes:jpg,png,jpeg,pdf,xlx,csv|max:2048';
                    } elseif ($request->$fldfile == "yes" && $request->$fldmndtryname != "yes") {

                        $fldname = $fldname . "[]";

                        $validate_array[$fldname] = 'mimes:jpg,png,jpeg,pdf,xlx,csv|max:2048';
                    } elseif ($request->$fldfile != "yes" && $request->$fldmndtryname == "yes") {

                        $validate_array[$fldname] = 'required';

                        $attr_array[$fldname] = $val;
                    }
                }
            }



            $this->validate($request, $validate_array, [], $attr_array);
        } else {

            foreach ($request->template_menus_id as $template_menus_id_val) {



                $label_name = "label_" . $template_menus_id_val;

                foreach ($request->$label_name as $val) {

                    $fldmndtryname = "field_mendatory_" . $template_menus_id_val . "_" . $val . "";

                    $fldname = "field_" . $template_menus_id_val . "_" . $val . "";

                    $fldfile = "field_file_" . $template_menus_id_val . "_" . $val;

                    if ($request->$fldfile == "yes" && $request->$fldmndtryname != "yes") {

                        $fldname = $fldname . "[]";

                        $validate_array[$fldname] = 'mimes:jpg,png,jpeg,pdf,xlx,csv|max:2048';
                    }
                }
            }



            $this->validate($request, $validate_array, [], $attr_array);
        }



        $year = date("Y");

        $month = date("m");

        $after_save_images = array();

        $after_save_respond = array();

        if (isset($request->comment) &&  !empty($request->comment)) {

            $comment = new Comment;

            $comment->user_id = session('id');

            $comment->treatment_id = $request->treatment_id;

            $comment->comment = $request->comment;

            $comment->save();
        }

        if (isset($request->standards) && $request->standards == '1') {

            $treatment->standards_management = '1';

            $treatment->save();

            for ($abc = 0; $abc < 4; $abc++) {

                $reporting_methods_arr = array();

                $standards_management_default_value_arr = array();

                $reporting_methods_str = "";

                if ($abc == 0) {

                    $reporting_methods_arr = $request->reporting_methods;

                    $standards_management = Standards_management::where('field_key', 'الأساليب المستخدمة بالتقرير')->first();

                    $treatment_standards_management = Treatment_standards_management::where('field_key', 'الأساليب المستخدمة بالتقرير')->where('treatment_id', $request->treatment_id)->first();
                } elseif ($abc == 1) {

                    $reporting_methods_arr = $request->evaluation_methods;

                    $standards_management = Standards_management::where('field_key', 'طرق التقييم')->first();

                    $treatment_standards_management = Treatment_standards_management::where('field_key', 'طرق التقييم')->where('treatment_id', $request->treatment_id)->first();
                } elseif ($abc == 2) {

                    $reporting_methods_arr = $request->basis_value;

                    $standards_management = Standards_management::where('field_key', 'أساس القيمة')->first();

                    $treatment_standards_management = Treatment_standards_management::where('field_key', 'أساس القيمة')->where('treatment_id', $request->treatment_id)->first();
                } elseif ($abc == 3) {

                    $reporting_methods_arr = $request->basis_valueall;

                    $standards_management = Standards_management::where('field_key', 'فرضية التقييم')->first();

                    $treatment_standards_management = Treatment_standards_management::where('field_key', 'فرضية التقييم')->where('treatment_id', $request->treatment_id)->first();
                }

                if (!empty($reporting_methods_arr)) {

                    sort($reporting_methods_arr);
                }

                $standards_management_default_value = $standards_management->default_value;

                if (!empty($standards_management_default_value)) {

                    $standards_management_default_value_arr =  explode(',', $standards_management_default_value);

                    if (!empty($standards_management_default_value_arr)) {

                        sort($standards_management_default_value_arr);
                    }
                }

                if ($reporting_methods_arr != $standards_management_default_value_arr || $treatment_standards_management) {

                    if (empty($reporting_methods_arr)) {

                        $reporting_methods_str = "";
                    } else {

                        $reporting_methods_str = implode(',', $reporting_methods_arr);
                    }



                    if ($treatment_standards_management) {
                    } else {

                        $treatment_standards_management = new Treatment_standards_management;
                    }



                    $treatment_standards_management->treatment_id = $request->treatment_id;

                    if ($abc == 0) {

                        $treatment_standards_management->field_key = 'الأساليب المستخدمة بالتقرير';
                    } elseif ($abc == 1) {

                        $treatment_standards_management->field_key = 'طرق التقييم';
                    } elseif ($abc == 2) {

                        $treatment_standards_management->field_key = 'أساس القيمة';
                    } elseif ($abc == 3) {

                        $treatment_standards_management->field_key = 'فرضية التقييم';
                    }


                    $treatment_standards_management->value = $reporting_methods_str;

                    $treatment_standards_management->save();
                }
            }



            if (isset($request->standards_management)) {

                $bc = 1;

                foreach ($request->standards_management as $standards_management_val) {

                    $kyname = "standards_management_key_" . $bc;

                    $valname = "standards_management_value_" . $bc;

                    $standards_management_key =  $request->$kyname;

                    if (!empty($standards_management_key)) {

                        $standards_management = Standards_management::where('field_key', $standards_management_key)->first();

                        $treatment_standards_management_new = Treatment_standards_management::where('field_key', $standards_management_key)->where('treatment_id', $request->treatment_id)->first();

                        if (empty($standards_management) && empty($treatment_standards_management_new)) {

                            $treatment_standards_management_new2 = new Treatment_standards_management;

                            $treatment_standards_management_new2->treatment_id = $request->treatment_id;

                            $treatment_standards_management_new2->field_key = $request->$kyname;

                            $treatment_standards_management_new2->value = $request->$valname;

                            $treatment_standards_management_new2->save();
                        } elseif (empty($standards_management) && !empty($treatment_standards_management_new)) {

                            $treatment_standards_management_new->treatment_id = $request->treatment_id;

                            $treatment_standards_management_new->field_key = $request->$kyname;

                            $treatment_standards_management_new->value = $request->$valname;

                            $treatment_standards_management_new->save();
                        } elseif (!empty($standards_management) && empty($treatment_standards_management_new)) {

                            if ($standards_management->value != $request->$valname) {

                                $treatment_standards_management_new3 = new Treatment_standards_management;

                                $treatment_standards_management_new3->treatment_id = $request->treatment_id;

                                $treatment_standards_management_new3->field_key = $request->$kyname;

                                $treatment_standards_management_new3->value = $request->$valname;

                                $treatment_standards_management_new3->save();
                            }
                        } elseif (!empty($standards_management) && empty($treatment_standards_management_new)) {

                            if ($standards_management->value != $request->$valname) {

                                // الحصول على آخر id موجود في الجدول
                                $lastId = Treatment_standards_management::max('id');

                                // تعيين id جديد بزيادة 1 على الأخير

                                $treatment_standards_management_new4 = new Treatment_standards_management;

                                $treatment_standards_management_new4->treatment_id = $request->treatment_id;

                                $treatment_standards_management_new4->field_key = $request->$kyname;

                                $treatment_standards_management_new4->value = $request->$valname;

                                $treatment_standards_management_new4->save();
                            }
                        } else {

                            $treatment_standards_management_new->treatment_id = $request->treatment_id;

                            $treatment_standards_management_new->field_key = $request->$kyname;

                            $treatment_standards_management_new->value = $request->$valname;

                            $treatment_standards_management_new->save();
                        }
                    }

                    $bc++;
                }
            }
        } else {

            $treatment->standards_management = '0';

            $treatment->save();
        }



        if (isset($request->images_check) &&  !empty($request->images_check)) {

            $pdf_images = implode(',', $request->images_check);

            $treatment->pdf_images = $pdf_images;

            $treatment->save();
        }



        foreach ($request->template_menus_id as $template_menus_id_val) {


            $label_name = "label_" . $template_menus_id_val;



            foreach ($request->$label_name as $val) {


                $property_attribute_key = $val;

                $fldarray = "field_array_" . $template_menus_id_val . "_" . $val;

                $fldfile = "field_file_" . $template_menus_id_val . "_" . $val;

                $property_attribute_value = "field_" . $template_menus_id_val . "_" . $val;

                $property_area  =  $property_price = "";

                $property_area = "area_field_" . $template_menus_id_val . "_" . $val;

                $property_price = "price_field_" . $template_menus_id_val . "_" . $val;
                $property_header = "header_field_" . $template_menus_id_val . "_" . $val;

                $property_header_go = "header_go_field_" . $template_menus_id_val . "_" . $val;



                if ($request->widget_id == '3' || $request->widget_id == '4' || $request->widget_id == '27') {

                    $property_a = $property_b = $property_c = $property_d = $property_e = $property_f = $property_g = $property_i = "";

                    $property_a = "a_field_" . $template_menus_id_val . "_" . $val;

                    $property_b = "b_field_" . $template_menus_id_val . "_" . $val;

                    $property_c = "c_field_" . $template_menus_id_val . "_" . $val;

                    $property_d = "d_field_" . $template_menus_id_val . "_" . $val;

                    $property_e = "e_field_" . $template_menus_id_val . "_" . $val;

                    $property_f = "f_field_" . $template_menus_id_val . "_" . $val;

                    $property_g = "g_field_" . $template_menus_id_val . "_" . $val;

                    if ($request->widget_id == '3') {
                        $property_i = "i_field_" . $template_menus_id_val . "_" . $val;
                    }
                }

                if ($request->widget_id_t == '18' || $request->widget_id_t == '45' || $request->widget_id_t == '31' || $request->widget_id_t == '47' || $request->widget_id_t == '45' || $request->widget_id_t == '49') {

                    $property_a = $property_b = $property_c = $property_d = "";

                    $property_a = "a_field_" . $template_menus_id_val . "_" . $val;

                    $property_b = "b_field_" . $template_menus_id_val . "_" . $val;

                    $property_c = "c_field_" . $template_menus_id_val . "_" . $val;

                    $property_d = "d_field_" . $template_menus_id_val . "_" . $val;
                }



                if (isset($request->widget_dif_menu_id) &&  !empty($request->widget_dif_menu_id) && $request->widget_dif_menu_id == $template_menus_id_val || isset($request->widget_dif_menu_idxx) &&  !empty($request->widget_dif_menu_idxx) && $request->widget_dif_menu_idxx == $template_menus_id_val) {

                    if (
                        $request->widget_dif_id == '10' || $request->widget_dif_id == '17'
                        || $request->widget_dif_id == '29' || $request->widget_dif_id == '30' || $request->widget_dif_id == '28'
                    ) {

                        $comparative_a = $comparative_b = $comparative_c = $comparative_d = $comparative_e = $comparative_f = "";

                        $comparative_a = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                        $comparative_b = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                        $comparative_c = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                        $comparative_d = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                        $comparative_e = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                        $comparative_g = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                        $comparative_h = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                        $comparative_j = "cmp_j_field_" . $template_menus_id_val . "_" . $val;

                        if ($request->widget_dif_id == '10') {
                            $comparative_f = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                        }

                        if ($request->widget_dif_idxx == '41') {

                            $comparative_ax = $comparative_bx = $comparative_cx = $comparative_dx = $comparative_ex = $comparative_fx = "";

                            $comparative_ax = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                            $comparative_bx = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                            $comparative_cx = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                            $comparative_dx = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                            $comparative_ex = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                            $comparative_gx = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                            $comparative_hx = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                            $comparative_jx = "cmp_j_field_" . $template_menus_id_val . "_" . $val;

                            if ($request->widget_dif_idxx == '41') {
                                $comparative_fx = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                            }
                        }
                    }
                }

                $treatment_detail = Treatment_detail::where([

                    ['treatment_id', '=', $request->treatment_id],

                    ['template_menus_id', '=', $template_menus_id_val],

                    ['property_attribute_key', '=', $property_attribute_key]

                ])->first();



                if ($treatment_detail) {

                    //update

                    $treatment_detail->treatment_id = $request->treatment_id;

                    $treatment_detail->template_menus_id = $template_menus_id_val;

                    $treatment_detail->property_attribute_key = $property_attribute_key;



                    if ($request->$fldarray == "yes") {

                        if (!empty($request->$property_attribute_value)) {



                            $input_array_string = implode(',', $request->$property_attribute_value);
                        } else {

                            $input_array_string = "";
                        }

                        $treatment_detail->property_attribute_value = $input_array_string;
                    } elseif ($request->$fldfile == "yes") {



                        if ($request->hasFile($property_attribute_value)) {

                            //$path_year_archive =  "uploads/$year";
                            $path_year_archive =  public_path("uploads/$year");
                            $watermark =  public_path("assets/images/watermark.png");

                            if (!File::isDirectory($path_year_archive)) {

                                File::makeDirectory($path_year_archive, 0777, true, true);
                            }

                            $path_month_archive =  $path_year_archive . '/' . $month . '/' . $treatment_detail->treatment_id;

                            if (!File::isDirectory($path_month_archive)) {

                                File::makeDirectory($path_month_archive, 0777, true, true);
                            }

                            $files_name_array = [];

                            if ($treatment_detail->property_attribute_value) {

                                $files_name_array =  explode(',', $treatment_detail->property_attribute_value);
                            }

                            foreach ($request->$property_attribute_value as $file) {

                                $fileName = $file->getClientOriginalName() . '_' . time() . '.' . $file->extension();

                                $img = Image::make($file->path());

                                $img2 = Image::make($file->path());

                                $resized_image = $img->resize(555, 355, function ($constraint) {

                                    $constraint->aspectRatio();
                                });

                                $datetime = now();

                                $resized_image_big = $img2->resize(1500, 800, function ($constraint) {

                                    $constraint->aspectRatio();
                                });

                                if ($property_attribute_key == "صورالعقار" || $property_attribute_key == "صورةالعقار") {

                                    $date_on_pic_ex = 'field_' . $template_menus_id_val . '_تواريخعلىصورالعقارالخارجية';
                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303 && $template_menus_id_val != 143 && $template_menus_id_val != 985) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985 || $template_menus_id_val != 4675 || $template_menus_id_val != 6705) && isset($request->$date_on_pic_ex))) {

                                        $resized_image->text($datetime, 105, 25, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(20);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    $resized_image->insert($watermark, 'bottom-right', 10, 20);


                                    //$success = Storage::disk('s3')->put($path_month_archive.'/'.'small_'.$fileName, $resized_image->stream() );
                                    $resized_image->save($path_month_archive . '/' . 'small_' . $fileName);
                                }
                                if ($property_attribute_key == "صورالعقار" || $property_attribute_key == "صورةالعقار") {

                                    $date_on_pic_ex = 'field_' . $template_menus_id_val . '_تواريخعلىصورالعقارالخارجية';
                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303 && $template_menus_id_val != 143 && $template_menus_id_val != 985) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985) && isset($request->$date_on_pic_ex))) {

                                        $resized_image_big->text($datetime, 200, 50, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(40);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    //Storage::disk('s3')->put($path_month_archive.'/'.'big_'.$fileName, $resized_image_big->stream() );
                                    $resized_image_big->save($path_month_archive . '/' . 'big_' . $fileName);
                                    $TreatmentidForPath = $treatment_detail->treatment_id;
                                    if ($resized_image) {

                                        $file_path = "uploads/$year/$month/$TreatmentidForPath";

                                        $files_name_array[] =  $file_path  . '/' . 'small_' . $fileName;
                                    }

                                    /*

                    if($file->move( $path_month_archive, $fileName)){

                        $file_path = "uploads/$year/$month";

                        $files_name_array[] =  $file_path  . '/' .$fileName;

                }

                */
                                }

                                if ($property_attribute_key == "صورلحالةالرفض" || $property_attribute_key == "صورلحالةالرفض") {

                                    $date_on_pic_ref = 'field_' . $template_menus_id_val . '_تواريخعلىصورالرفض';
                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303 && $template_menus_id_val != 143 && $template_menus_id_val != 985) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985) && isset($request->$date_on_pic_ref))) {

                                        $resized_image->text($datetime, 105, 25, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(20);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    $resized_image->insert($watermark, 'bottom-right', 10, 20);


                                    //$success = Storage::disk('s3')->put($path_month_archive.'/'.'small_'.$fileName, $resized_image->stream() );
                                    $resized_image->save($path_month_archive . '/' . 'small_' . $fileName);
                                }
                                if ($property_attribute_key == "صورلحالةالرفض" || $property_attribute_key == "صورلحالةالرفض") {

                                    $date_on_pic_ref = 'field_' . $template_menus_id_val . '_تواريخعلىصورالرفض';
                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303 && $template_menus_id_val != 143 && $template_menus_id_val != 985) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985) && isset($request->$date_on_pic_ref))) {

                                        $resized_image_big->text($datetime, 200, 50, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(40);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    //Storage::disk('s3')->put($path_month_archive.'/'.'big_'.$fileName, $resized_image_big->stream() );
                                    $resized_image_big->save($path_month_archive . '/' . 'big_' . $fileName);
                                    $TreatmentidForPath = $treatment_detail->treatment_id;
                                    if ($resized_image) {

                                        $file_path = "uploads/$year/$month/$TreatmentidForPath";

                                        $files_name_array[] =  $file_path  . '/' . 'small_' . $fileName;
                                    }

                                    /*

                    if($file->move( $path_month_archive, $fileName)){

                        $file_path = "uploads/$year/$month";

                        $files_name_array[] =  $file_path  . '/' .$fileName;

                }

                */
                                }

                                if ($property_attribute_key == "صورالعقارمنالداخل" || $property_attribute_key == "صورالعقارمنالداخل") {

                                    $date_on_pic_in = 'field_' . $template_menus_id_val . '_تواريخعلىصورالعقارالداخلية';
                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 143 && $template_menus_id_val != 985 && $template_menus_id_val != 303) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985) && isset($request->$date_on_pic_in))) {

                                        $resized_image->text($datetime, 105, 25, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(20);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    $resized_image->insert($watermark, 'bottom-right', 10, 20);


                                    //$success = Storage::disk('s3')->put($path_month_archive.'/'.'small_'.$fileName, $resized_image->stream() );
                                    $resized_image->save($path_month_archive . '/' . 'small_' . $fileName);
                                }
                                if ($property_attribute_key == "صورالعقارمنالداخل" || $property_attribute_key == "صورالعقارمنالداخل") {

                                    $date_on_pic_in = 'field_' . $template_menus_id_val . '_تواريخعلىصورالعقارالداخلية';
                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303 && $template_menus_id_val != 143 && $template_menus_id_val != 985) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985) && isset($request->$date_on_pic_in))) {

                                        $resized_image_big->text($datetime, 200, 50, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(40);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    //Storage::disk('s3')->put($path_month_archive.'/'.'big_'.$fileName, $resized_image_big->stream() );
                                    $resized_image_big->save($path_month_archive . '/' . 'big_' . $fileName);
                                    $TreatmentidForPath = $treatment_detail->treatment_id;
                                    if ($resized_image) {

                                        $file_path = "uploads/$year/$month/$TreatmentidForPath";

                                        $files_name_array[] =  $file_path  . '/' . 'small_' . $fileName;
                                    }

                                    /*

                    if($file->move( $path_month_archive, $fileName)){

                        $file_path = "uploads/$year/$month";

                        $files_name_array[] =  $file_path  . '/' .$fileName;

                }

                */
                                }

                                if ($property_attribute_key == "صورالعدادات" || $property_attribute_key == "صورالعدادات") {

                                    $date_on_pic_meter = 'field_' . $template_menus_id_val . '_تواريخعلىصورالعدادات';

                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303 && $template_menus_id_val != 143 && $template_menus_id_val != 985) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985) && isset($request->$date_on_pic_meter))) {

                                        $resized_image->text($datetime, 105, 25, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(20);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    $resized_image->insert($watermark, 'bottom-right', 10, 20);


                                    //$success = Storage::disk('s3')->put($path_month_archive.'/'.'small_'.$fileName, $resized_image->stream() );
                                    $resized_image->save($path_month_archive . '/' . 'small_' . $fileName);
                                }
                                if ($property_attribute_key == "صورالعدادات" || $property_attribute_key == "صورالعدادات") {
                                    $date_on_pic_meter = 'field_' . $template_menus_id_val . '_تواريخعلىصورالعدادات';

                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303 && $template_menus_id_val != 143 && $template_menus_id_val != 985) || (($template_menus_id_val == 303 ||  $template_menus_id_val == 143 ||  $template_menus_id_val == 985) && isset($request->$date_on_pic_meter))) {

                                        $resized_image_big->text($datetime, 200, 50, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(40);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    //Storage::disk('s3')->put($path_month_archive.'/'.'big_'.$fileName, $resized_image_big->stream() );
                                    $resized_image_big->save($path_month_archive . '/' . 'big_' . $fileName);
                                    $TreatmentidForPath = $treatment_detail->treatment_id;
                                    if ($resized_image) {

                                        $file_path = "uploads/$year/$month/$TreatmentidForPath";

                                        $files_name_array[] =  $file_path  . '/' . 'small_' . $fileName;
                                    }

                                    /*

                    if($file->move( $path_month_archive, $fileName)){

                        $file_path = "uploads/$year/$month";

                        $files_name_array[] =  $file_path  . '/' .$fileName;

                }

                */
                                }
                                //else{
                                if ($property_attribute_key != "صورالعقار" && $property_attribute_key != "صورةالعقار" && $property_attribute_key != "صورلحالةالرفض" && $property_attribute_key != "صورالعقارمنالداخل" && $property_attribute_key != "صورالعدادات") {
                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303)) {

                                        $resized_image->text($datetime, 105, 25, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(20);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    $resized_image->insert($watermark, 'bottom-right', 10, 20);


                                    //$success = Storage::disk('s3')->put($path_month_archive.'/'.'small_'.$fileName, $resized_image->stream() );
                                    $resized_image->save($path_month_archive . '/' . 'small_' . $fileName);


                                    if (($treatment->template_form->client->date_on_pic == '1' && $template_menus_id_val != 303)) {

                                        $resized_image_big->text($datetime, 200, 50, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(40);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    //Storage::disk('s3')->put($path_month_archive.'/'.'big_'.$fileName, $resized_image_big->stream() );
                                    $resized_image_big->save($path_month_archive . '/' . 'big_' . $fileName);
                                    $TreatmentidForPath = $treatment_detail->treatment_id;
                                    if ($resized_image) {

                                        $file_path = "uploads/$year/$month/$TreatmentidForPath";

                                        $files_name_array[] =  $file_path  . '/' . 'small_' . $fileName;
                                    }



                                    /*  if($file->move( $path_month_archive, $fileName)){

                        $file_path = "uploads/$year/$month";

                        $files_name_array[] =  $file_path  . '/' .$fileName;

                }


				} */
                                }
                            }



                            $treatment_detail->property_attribute_value =  implode(',', $files_name_array);
                        }
                    } else {

                        if (isset($request->widget_dif_menu_id_39) &&  !empty($request->widget_dif_menu_id_39) && $request->widget_dif_menu_id_39 == $template_menus_id_val) {

                            if ($request->widget_dif_id_39 == '39') {
                                $comparative_f = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                                $comparative_a = $comparative_b = $comparative_c = $comparative_d = $comparative_e = "";

                                $comparative_a = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_b = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_c = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_d = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_e = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_g = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_h = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_j = "cmp_j_field_" . $template_menus_id_val . "_" . $val;
                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                $widget_cmp_data['f'] = $request->$comparative_f;

                                $widget_cmp_data['g'] = $request->$comparative_g;

                                $widget_cmp_data['h'] = $request->$comparative_h;

                                $widget_cmp_data['j'] = $request->$comparative_j;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } elseif (isset($request->widget_dif_menu_id_40) &&  !empty($request->widget_dif_menu_id_40) && $request->widget_dif_menu_id_40 == $template_menus_id_val) {

                            if ($request->widget_dif_id_40 == '40') {
                                $comparative_f = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                                $comparative_a = $comparative_b = $comparative_c = $comparative_d = $comparative_e = "";

                                $comparative_a = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_b = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_c = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_d = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_e = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_g = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_h = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_j = "cmp_j_field_" . $template_menus_id_val . "_" . $val;
                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                $widget_cmp_data['f'] = $request->$comparative_f;

                                $widget_cmp_data['g'] = $request->$comparative_g;

                                $widget_cmp_data['h'] = $request->$comparative_h;

                                $widget_cmp_data['j'] = $request->$comparative_j;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } elseif (isset($request->widget_dif_menu_id_42) &&  !empty($request->widget_dif_menu_id_42) && $request->widget_dif_menu_id_42 == $template_menus_id_val) {

                            if ($request->widget_dif_id_42 == 42) {
                                $comparative_f = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                                $comparative_a = $comparative_b = $comparative_c = $comparative_d = $comparative_e = "";

                                $comparative_a = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_b = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_c = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_d = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_e = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_g = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_h = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_j = "cmp_j_field_" . $template_menus_id_val . "_" . $val;
                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                $widget_cmp_data['f'] = $request->$comparative_f;

                                $widget_cmp_data['g'] = $request->$comparative_g;

                                $widget_cmp_data['h'] = $request->$comparative_h;

                                $widget_cmp_data['j'] = $request->$comparative_j;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } elseif (isset($request->widget_dif_menu_id_44) &&  !empty($request->widget_dif_menu_id_44) && $request->widget_dif_menu_id_44 == $template_menus_id_val) {

                            if ($request->widget_dif_id_44 == 44) {
                                $comparative_f = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                                $comparative_a = $comparative_b = $comparative_c = $comparative_d = $comparative_e = "";

                                $comparative_a = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_b = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_c = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_d = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_e = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_g = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_h = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_j = "cmp_j_field_" . $template_menus_id_val . "_" . $val;
                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                $widget_cmp_data['f'] = $request->$comparative_f;

                                $widget_cmp_data['g'] = $request->$comparative_g;

                                $widget_cmp_data['h'] = $request->$comparative_h;

                                $widget_cmp_data['j'] = $request->$comparative_j;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } elseif (isset($request->widget_dif_menu_id_46) &&  !empty($request->widget_dif_menu_id_46) && $request->widget_dif_menu_id_46 == $template_menus_id_val) {

                            if ($request->widget_dif_id_46 == 46) {
                                $comparative_f = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                                $comparative_a = $comparative_b = $comparative_c = $comparative_d = $comparative_e = "";

                                $comparative_a = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_b = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_c = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_d = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_e = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_g = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_h = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_j = "cmp_j_field_" . $template_menus_id_val . "_" . $val;
                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                $widget_cmp_data['f'] = $request->$comparative_f;

                                $widget_cmp_data['g'] = $request->$comparative_g;

                                $widget_cmp_data['h'] = $request->$comparative_h;

                                $widget_cmp_data['j'] = $request->$comparative_j;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } elseif (isset($request->widget_dif_menu_id_48) &&  !empty($request->widget_dif_menu_id_48) && $request->widget_dif_menu_id_48 == $template_menus_id_val) {

                            if ($request->widget_dif_id_48 == 48) {
                                $comparative_f = "cmp_f_field_" . $template_menus_id_val . "_" . $val;
                                $comparative_a = $comparative_b = $comparative_c = $comparative_d = $comparative_e = "";

                                $comparative_a = "cmp_a_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_b = "cmp_b_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_c = "cmp_c_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_d = "cmp_d_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_e = "cmp_e_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_g = "cmp_g_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_h = "cmp_h_field_" . $template_menus_id_val . "_" . $val;

                                $comparative_j = "cmp_j_field_" . $template_menus_id_val . "_" . $val;
                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                $widget_cmp_data['f'] = $request->$comparative_f;

                                $widget_cmp_data['g'] = $request->$comparative_g;

                                $widget_cmp_data['h'] = $request->$comparative_h;

                                $widget_cmp_data['j'] = $request->$comparative_j;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } elseif (($request->filled('widget_dif_menu_id') && $request->widget_dif_menu_id == $template_menus_id_val)
                            || ($request->filled('widget_dif_menu_idxx') && $request->widget_dif_menu_idxx == $template_menus_id_val)
                        ) {

                            if (
                                $request->widget_dif_id == '10' ||
                                $request->widget_dif_id == '17' || $request->widget_dif_id == '29' || $request->widget_dif_id == '30'
                                || $request->widget_dif_id == '28'
                            ) {

                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                if ($request->widget_dif_id == '10') {
                                    $widget_cmp_data['f'] = $request->$comparative_f;
                                }
                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }

                            if ($request->widget_dif_idxx == '41') {

                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_ax;

                                $widget_cmp_data['b'] = $request->$comparative_bx;

                                $widget_cmp_data['c'] = $request->$comparative_cx;

                                $widget_cmp_data['d'] = $request->$comparative_dx;

                                $widget_cmp_data['e'] = $request->$comparative_ex;

                                if ($request->widget_dif_idxx == '41') {
                                    $widget_cmp_data['f'] = $request->$comparative_fx;
                                }
                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } else {

                            $widget_data = array();

                            if ($request->widget_id == '3' || $request->widget_id == '4' || $request->widget_id == '27') {

                                if ($request->$property_area != null || $request->$property_price != null || $request->$property_header != null || $request->$property_header_go != null || $request->$property_a != null || $request->$property_b != null || $request->$property_c != null || $request->$property_d != null || $request->$property_e != null || $request->$property_f != null || $request->$property_g != null || $request->$property_i != null) {

                                    $widget_data['value'] = $request->$property_attribute_value;

                                    $widget_data['area'] = $request->$property_area;

                                    $widget_data['price'] = $request->$property_price;
                                    $widget_data['header'] = $request->$property_header;
                                    $widget_data['header_go'] = $request->$property_header_go;


                                    $widget_data['a'] = $request->$property_a;

                                    $widget_data['b'] = $request->$property_b;

                                    $widget_data['c'] = $request->$property_c;

                                    $widget_data['d'] = $request->$property_d;

                                    $widget_data['e'] = $request->$property_e;

                                    $widget_data['f'] = $request->$property_f;

                                    $widget_data['g'] = $request->$property_g;

                                    if ($request->widget_id == '3') {
                                        $widget_data['i'] = $request->$property_i;
                                    }

                                    $widget_data_json = json_encode($widget_data, JSON_FORCE_OBJECT);

                                    $treatment_detail->property_attribute_value = $widget_data_json;
                                } else {

                                    $treatment_detail->property_attribute_value = $request->$property_attribute_value;
                                }
                            }

                            if ($request->widget_id_t == '18' || $request->widget_id_t == '45' || $request->widget_id_t == '31' || $request->widget_id_t == '47' || $request->widget_id_t == '45' || $request->widget_id_t == '49') {

                                if ($request->$property_area != null || $request->$property_price != null || $request->$property_header != null || $request->$property_header_go != null || $request->$property_a != null || $request->$property_b != null || $request->$property_c != null || $request->$property_d != null) {

                                    $widget_data['value'] = $request->$property_attribute_value;

                                    $widget_data['area'] = $request->$property_area;

                                    $widget_data['price'] = $request->$property_price;
                                    $widget_data['header'] = $request->$property_header;
                                    $widget_data['header_go'] = $request->$property_header_go;

                                    $widget_data['a'] = $request->$property_a;

                                    $widget_data['b'] = $request->$property_b;

                                    $widget_data['c'] = $request->$property_c;

                                    $widget_data['d'] = $request->$property_d;

                                    $widget_data_json = json_encode($widget_data, JSON_UNESCAPED_UNICODE);

                                    $treatment_detail->property_attribute_value = $widget_data_json;
                                } else {

                                    $treatment_detail->property_attribute_value = $request->$property_attribute_value;
                                }
                            } else {

                                if ($request->$property_area != null || $request->$property_price != null || $request->$property_header != null || $request->$property_header_go != null) {

                                    $widget_data['value'] = $request->$property_attribute_value;

                                    $widget_data['area'] = $request->$property_area;

                                    $widget_data['price'] = $request->$property_price;
                                    $widget_data['header'] = $request->$property_header;
                                    $widget_data['header_go'] = $request->$property_header_go;

                                    $widget_data_json = json_encode($widget_data, JSON_UNESCAPED_UNICODE);

                                    $treatment_detail->property_attribute_value = $widget_data_json;
                                } else {

                                    $treatment_detail->property_attribute_value = $request->$property_attribute_value;
                                }
                            }
                        }
                    }



                    $saved_status =  $treatment_detail->save();



                    if ($saved_status && $request->$fldfile == "yes") {

                        $treatmnt_detail_image = Treatment_detail::findOrFail($treatment_detail->id);

                        $after_save_images[$fldfile] = [$treatment_detail->id, $treatmnt_detail_image->property_attribute_value, $property_attribute_key];
                    }
                } else {



                    //insert

                    $treatment_detail = new Treatment_detail;

                    $treatment_detail->treatment_id = $request->treatment_id;

                    $treatment_detail->template_menus_id = $template_menus_id_val;

                    $treatment_detail->property_attribute_key = $property_attribute_key;

                    if ($request->$fldarray == "yes") {

                        if (!empty($request->$property_attribute_value)) {



                            $input_array_string = implode(',', $request->$property_attribute_value);
                        } else {

                            $input_array_string = "";
                        }

                        $treatment_detail->property_attribute_value = $input_array_string;
                    } elseif ($request->$fldfile == "yes") {

                        if ($request->hasFile($property_attribute_value)) {

                            //$path_year_archive =  "uploads/$year";
                            $path_year_archive =  public_path("uploads/$year");

                            $watermark =  public_path("assets/images/watermark.png");

                            if (!File::isDirectory($path_year_archive)) {

                                File::makeDirectory($path_year_archive, 0777, true, true);
                            }

                            $path_month_archive =  $path_year_archive . '/' . $month . '/' . $treatment_detail->treatment_id;

                            if (!File::isDirectory($path_month_archive)) {

                                File::makeDirectory($path_month_archive, 0777, true, true);
                            }

                            $files_name_array = [];

                            if ($treatment_detail->property_attribute_value) {

                                $files_name_array =  explode(',', $treatment_detail->property_attribute_value);
                            }

                            foreach ($request->$property_attribute_value as $file) {

                                $fileName = $file->getClientOriginalName() . '_' . time() . '.' . $file->extension();

                                $img = Image::make($file->path());

                                $img2 = Image::make($file->path());

                                $resized_image = $img->resize(555, 355, function ($constraint) {

                                    $constraint->aspectRatio();
                                });

                                $datetime = now();

                                $resized_image_big = $img2->resize(1500, 800, function ($constraint) {

                                    $constraint->aspectRatio();
                                });

                                if ($property_attribute_key == "صورالعقار" || $property_attribute_key == "صورةالعقار") {

                                    if ($treatment->template_form->client->date_on_pic == '1') {

                                        $resized_image->text($datetime, 105, 25, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(20);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }

                                    $resized_image->insert($watermark, 'bottom-right', 10, 20);
                                }
                                //$success = Storage::disk('s3')->put($path_month_archive.'/'.'small_'.$fileName, $resized_image->stream() );
                                $resized_image->save($path_month_archive . '/' . 'small_' . $fileName);

                                if ($property_attribute_key == "صورالعقار" || $property_attribute_key == "صورةالعقار") {

                                    if ($treatment->template_form->client->date_on_pic == '1') {

                                        $resized_image_big->text($datetime, 200, 50, function ($font) {

                                            $font->file(public_path('assets/fonts/arial.ttf'));

                                            $font->size(40);

                                            $font->color('#000000');

                                            $font->align('center');

                                            $font->valign('bottom');

                                            $font->angle(0);
                                        });
                                    }
                                }

                                //Storage::disk('s3')->put($path_month_archive.'/'.'big_'.$fileName, $resized_image_big->stream() );
                                $resized_image_big->save($path_month_archive . '/' . 'big_' . $fileName);
                                $TreatmentidForPath = $treatment_detail->treatment_id;
                                if ($resized_image) {

                                    $file_path = "uploads/$year/$month/$TreatmentidForPath";

                                    $files_name_array[] =  $file_path  . '/' . 'small_' . $fileName;
                                }

                                /*

                        if($file->move( $path_month_archive, $fileName)){

                            $file_path = "uploads/$year/$month";

                            $files_name_array[] =  $file_path  . '/' .$fileName;

                    }*/
                            }



                            $treatment_detail->property_attribute_value =  implode(',', $files_name_array);
                        }
                    } else {

                        /*

                    $treatment_detail->property_attribute_value = $request->$property_attribute_value;

                    $treatment_detail->area = $request->$property_area;

                    $treatment_detail->price = $request->$property_price;

                    */

                        if (($request->filled('widget_dif_menu_id') && $request->widget_dif_menu_id == $template_menus_id_val)
                            || ($request->filled('widget_dif_menu_idxx') && $request->widget_dif_menu_idxx == $template_menus_id_val)
                        ) {

                            if (
                                $request->widget_dif_id == '10' ||
                                $request->widget_dif_id == '17' ||
                                $request->widget_dif_id == '29' || $request->widget_dif_id == '30' || $request->widget_dif_id == '28'
                            ) {

                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_a;

                                $widget_cmp_data['b'] = $request->$comparative_b;

                                $widget_cmp_data['c'] = $request->$comparative_c;

                                $widget_cmp_data['d'] = $request->$comparative_d;

                                $widget_cmp_data['e'] = $request->$comparative_e;

                                $widget_cmp_data['f'] = $request->$comparative_f;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                            if ($request->widget_dif_idxx == '41') {

                                $widget_cmp_data = array();

                                $widget_cmp_data['a'] = $request->$comparative_ax;

                                $widget_cmp_data['b'] = $request->$comparative_bx;

                                $widget_cmp_data['c'] = $request->$comparative_cx;

                                $widget_cmp_data['d'] = $request->$comparative_dx;

                                $widget_cmp_data['e'] = $request->$comparative_ex;

                                $widget_cmp_data['f'] = $request->$comparative_fx;

                                $widget_cmp_data_json = json_encode($widget_cmp_data, JSON_UNESCAPED_UNICODE, JSON_FORCE_OBJECT);

                                $treatment_detail->property_attribute_value = $widget_cmp_data_json;
                            }
                        } else {

                            $widget_data = array();

                            if ($request->widget_id == '3' || $request->widget_id == '4' || $request->widget_id == '27') {

                                if ($request->$property_area != null || $request->$property_price != null || $request->$property_header != null || $request->$property_a != null || $request->$property_b != null || $request->$property_c != null || $request->$property_d != null || $request->$property_e != null || $request->$property_f != null || $request->$property_g != null || $request->$property_i != null) {

                                    $widget_data['value'] = $request->$property_attribute_value;

                                    $widget_data['area'] = $request->$property_area;

                                    $widget_data['price'] = $request->$property_price;

                                    $widget_data['header'] = $request->$property_header;

                                    $widget_data['a'] = $request->$property_a;

                                    $widget_data['b'] = $request->$property_b;

                                    $widget_data['c'] = $request->$property_c;

                                    $widget_data['d'] = $request->$property_d;

                                    $widget_data['e'] = $request->$property_e;

                                    $widget_data['f'] = $request->$property_f;

                                    $widget_data['g'] = $request->$property_g;

                                    if ($request->widget_id == '3') {
                                        $widget_data['i'] = $request->$property_i;
                                    }

                                    $widget_data_json = json_encode($widget_data, JSON_FORCE_OBJECT);

                                    $treatment_detail->property_attribute_value = $widget_data_json;
                                } else {

                                    $treatment_detail->property_attribute_value = $request->$property_attribute_value;
                                }
                            } else {

                                if ($request->$property_area != null || $request->$property_price != null || $request->$property_header != null) {

                                    $widget_data['value'] = $request->$property_attribute_value;

                                    $widget_data['area'] = $request->$property_area;

                                    $widget_data['price'] = $request->$property_price;
                                    $widget_data['header'] = $request->$property_header;


                                    $widget_data_json = json_encode($widget_data, JSON_UNESCAPED_UNICODE);

                                    $treatment_detail->property_attribute_value = $widget_data_json;
                                } else {

                                    $treatment_detail->property_attribute_value = $request->$property_attribute_value;
                                }
                            }
                        }
                    }



                    $saved_status =  $treatment_detail->save();



                    if ($saved_status && $request->$fldfile == "yes") {

                        $treatmnt_detail_image = Treatment_detail::findOrFail($treatment_detail->id);

                        $after_save_images[$fldfile] = [$treatment_detail->id, $treatmnt_detail_image->property_attribute_value, $property_attribute_key];
                    }
                }
            }
        }

        if ($request->submit_completed && $saved_status) {


            $user = Auth::user();

            $user_id = $user->id;

            $usertype =  session('usertype');


            $id = $request->treatment_id;

            $treatment = Treatment::findOrFail($id);

            $status_treatment = Status_treatment::where('treatment_id', $id)

                ->where('user_id', $user_id)

                ->where('user_type', $usertype)

                ->first();



            if (!empty($status_treatment)) {

                $status_treatment->status = "3";

                $status_treatment->complete_at =  date("Y-m-d H:i:s");

                $status_treatment->save();

                if ($usertype == "Field Inspector" || $usertype == "Data Entry") {

                    $check_task_complete_both = Status_treatment::where('treatment_id', $id)

                        ->where('status', '!=', '3')

                        ->whereIn('user_type', ["Field Inspector", "Data Entry"])

                        ->first();



                    if (empty($check_task_complete_both)) {



                        //make cooordianato task done

                        //  $notify_coordinator->status = "3";

                        //  $notify_coordinator->save();

                        //send notification to coordinator

                        $notification = new Notification;
                        //---------------------------
                        $notification->user_id =  $notify_coordinator->user_id;

                        $notification->content = "Treatment " . $id . " completed by both Field Inspector and Data Entry.";

                        $notification->content_ar = "معاملة برقم " . $id . " اكتملت من المعاين الميداني ومدخل البيانات.";

                        $notification->save();

                        //-----------------------------

                        //make treatment status evaulation department

                        $treatment->status = "4";

                        $treatment->save();



                        //make evaluation task assign

                        $notify_evaluation = Status_treatment::where('treatment_id', $id)

                            ->where('user_type', 'Evaluation')

                            ->first();

                        $notify_evaluation->status = "0";

                        $notify_evaluation->assigned_at =  date("Y-m-d H:i:s");

                        $notify_evaluation->save();

                        //send notification to evaulation

                        $notification = new Notification;

                        $notification->user_id =  $notify_evaluation->user_id;

                        $notification->content = "A treatment " . $id . " assigned to you.";

                        $notification->content_ar = "تم تعيين معاملة برقم " . $id . " لك.";

                        $notification->save();
                    }
                } elseif ($usertype == "Coordinator" || $usertype == "Coordinator Supervisor") {

                    //make evaluation task assign

                    $notify_evaluation = Status_treatment::where('treatment_id', $id)

                        ->where('user_type', 'Evaluation')

                        ->first();

                    $notify_evaluation->status = "0";

                    $notify_evaluation->assigned_at =  date("Y-m-d H:i:s");

                    $notify_evaluation->save();

                    //send notification to evaulation

                    $notification = new Notification;

                    $notification->user_id =  $notify_evaluation->user_id;

                    $notification->content = "A treatment " . $id . " assigned to you.";

                    $notification->content_ar = "تم تعيين معاملة برقم " . $id . " لك.";

                    $notification->save();

                    $treatment->status = "4";

                    $treatment->save();
                } elseif ($usertype == "Evaluation" || $usertype == "Evaluation Supervisor") {

                    //make Approval department task assign

                    $notify_approval = Status_treatment::where('treatment_id', $id)

                        ->where('user_type', 'Approval and Review')

                        ->first();

                    $notify_approval->status = "0";

                    $notify_approval->assigned_at = date("Y-m-d H:i:s");

                    $notify_approval->save();

                    //send notification to Approval Department

                    $notification = new Notification;

                    $notification->user_id =  $notify_approval->user_id;

                    $notification->content = "A treatment " . $id . " assigned to you.";

                    $notification->content_ar = "تم تعيين معاملة برقم " . $id . " لك.";

                    $notification->save();

                    //make treatment status Approval and Review department

                    $treatment->status = "5";

                    $treatment->save();
                } elseif ($usertype == "Approval and Review" || $usertype == "Approval Supervisor") {

                    if ($treatment->template_form->client->sent_type == '1') {

                        //notify coordinator to send pdf

                        $notify_coordinator = Status_treatment::where('treatment_id', $id)

                            ->where('user_type', 'Coordinator')

                            ->first();

                        if ($notify_coordinator) {

                            $notification = new Notification;

                            $notification->user_id =  $notify_coordinator->user_id;

                            $notification->content = "Treatment " . $id . " finished.";

                            $notification->content_ar = "معاملة برقم " . $id . " اكتملت.";

                            $notification->save();
                        }
                    }

                    //send notification to admin Department task finished

                    $notification = new Notification;

                    $notification->user_id =  "1";

                    $notification->content = "Treatment " . $id . " finished.";

                    $notification->content_ar = "معاملة برقم " . $id . " اكتملت.";

                    $notification->save();

                    //make treatment status complete department

                    $treatment->complete_at = date("Y-m-d H:i:s");

                    $treatment->status = "8";

                    $treatment->save();
                }
            } else {

                if ($usertype == "Admin") {

                    //make treatment status complete department

                    $treatment->complete_at = date("Y-m-d H:i:s");

                    $treatment->status = "8";

                    $treatment->save();

                    if ($treatment->template_form->client->sent_type == '1') {

                        //notify coordinator to send pdf

                        $notify_coordinator = Status_treatment::where('treatment_id', $id)

                            ->where('user_type', 'Coordinator')

                            ->first();

                        if ($notify_coordinator) {

                            $notification = new Notification;

                            $notification->user_id =  $notify_coordinator->user_id;

                            $notification->content = "Treatment " . $id . " finished.";

                            $notification->content_ar = "معاملة برقم " . $id . " اكتملت.";

                            $notification->save();
                        }
                    }
                }
            }

            $treatment_after_save = Treatment::findOrFail($request->treatment_id);
            $treatment_save_log_after_save = Treatment_save_log::findOrFail($treatment_save_log->id);
            $treatment_save_log_after_save->status_after_save = $treatment_after_save->status;
            $treatment_save_log_after_save->save();


            return redirect("treatment/$request->treatment_id/edit")->with('message', 'Treatment Completed Successful.');
        } elseif (! $request->submit_completed && $saved_status) {

            $treatment_after_save = Treatment::findOrFail($request->treatment_id);
            $treatment_save_log_after_save = Treatment_save_log::findOrFail($treatment_save_log->id);
            $treatment_save_log_after_save->status_after_save = $treatment_after_save->status;
            $treatment_save_log_after_save->save();

            $comment_saved = "";

            $images_pdf = "";

            $comment_saved = Comment::where('treatment_id', $request->treatment_id)->with('user')->get();

            $images_pdf = $treatment->pdf_images;

            $after_save_respond['comments']  = $comment_saved;

            $after_save_respond['images'] = $after_save_images;

            $after_save_respond['images_pdf']  = $images_pdf;

            $after_save_respond = json_encode($after_save_respond);

            return $after_save_respond;
        }
    }



    public function widget_store(Request $request) {}

    public function deleteComment(Request $request, $id, $treatment_id)
    {

        // Find the comment by its ID and treatment_id
        $comment = Comment::where('id', $id)
            ->where('treatment_id', $treatment_id)
            ->first();

        if ($comment) {
            // Optionally, check if the user has permission to delete the comment

            // Delete the comment
            $comment->delete();

            // Return a success response
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

    }



    public function file_delete(Request $request)
    {



        $treatment_detail = Treatment_detail::findOrFail($request->treatment_detail_id);

        $file_names_string = $treatment_detail->property_attribute_value;

        if (!empty($file_names_string)) {

            $file_names_array = explode(',', $file_names_string);

            $key = array_search($request->name, $file_names_array);

            unset($file_names_array[$key]);

            $file_names_string_new = implode(',', $file_names_array);

            $treatment_detail->property_attribute_value = $file_names_string_new;

            $saved_status = $treatment_detail->save();
        }

        if ($treatment_detail) {

            $treatment = Treatment::findOrFail($treatment_detail->treatment_id);

            $pdf_file_names_string = $treatment->pdf_images;

            if (!empty($pdf_file_names_string)) {

                $pdf_file_names_array = explode(',', $pdf_file_names_string);

                $pdf_key = array_search($request->name, $pdf_file_names_array);

                unset($pdf_file_names_array[$pdf_key]);

                $pdf_file_names_string_new = implode(',', $pdf_file_names_array);

                $treatment->pdf_images = $pdf_file_names_string_new;

                $saved_status2 = $treatment->save();
            }
        }

        if ($saved_status || $saved_status2) {

            return response()->json([

                'status' => 1,

                'message' => 'File deleted successfully!'

            ]);
        } else {

            return response()->json([

                'status' => 0,

                'message' => 'Sorry Fail to delet'

            ]);
        }









        /* $company = Company::find($id);

        $company->delete();

        return response()->json([

          'message' => 'Data deleted successfully!'

        ]);

        */
    }



    public function file_delete_all(Request $request)
    {



        $treatment_detail = Treatment_detail::findOrFail($request->treatment_detail_id);

        if ($treatment_detail) {

            $treatment = Treatment::findOrFail($treatment_detail->treatment_id);
        }

        $treatment_detail->property_attribute_value = "";

        $saved_status = $treatment_detail->save();

        $treatment->pdf_images = "";

        $saved_status2 = $treatment->save();

        if ($saved_status || $saved_status2) {

            return response()->json([

                'status' => 1,

                'message' => 'File deleted successfully!'

            ]);
        } else {

            return response()->json([

                'status' => 0,

                'message' => 'Sorry Fail to delet'

            ]);
        }









        /* $company = Company::find($id);

    $company->delete();

    return response()->json([

      'message' => 'Data deleted successfully!'

    ]);

    */
    }

    public function map_filter(Request $request)
    {



        $propclassification = $from = $to = NULL;



        if (isset($request->propclassification) && !empty($request->propclassification)) {

            $propclassification = $request->propclassification;
        }

        if (isset($request->from) && !empty($request->from)) {

            $from = $request->from;
        } else {

            $from = date('Y-m-d', strtotime("-12 month"));
        }

        if (isset($request->to) && !empty($request->to)) {

            $to = $request->to;
        } else {

            $to = date('Y-m-d', time());;
        }

        $params = [$request->min_lat, $request->max_lat, $request->min_lng, $request->max_lng];

        $mysqlquery = Treatment::with(['treatment_detail' => function ($q) {

            $q->where('property_attribute_key', 'الأرض')

                ->orwhere('property_attribute_key', 'قطعةالأرض')

                ->orwhere('property_attribute_key', 'الارض')

                ->orwhere('property_attribute_key', 'صورةالأقمارالصناعیة');
        }])->where('status', '=', '8')->orwhere('status', '=', '9')

            ->whereBetween('created_at', [$from, $to]);

        if ($propclassification) {

            $mysqlquery = $mysqlquery->where('property_classification_id', $propclassification);
        }

        $mysqlquery = $mysqlquery->WhereHas('treatment_detail', function ($query) use ($params) {

            $query->where('property_attribute_key', 'صورةالأقمارالصناعیة');
        });

        $treatment = $mysqlquery
            // ->where('type','project')

            ->orderBy('id')

            ->get();

        $treatment2 = $treatment->filter(function ($item) use ($params) {

            foreach ($item->treatment_detail as $treatment_detail_val) {

                if (!empty($treatment_detail_val->property_attribute_value)) {

                    if ($treatment_detail_val->property_attribute_key == "صورةالأقمارالصناعیة") {

                        $cord_arr =  explode(',', $treatment_detail_val->property_attribute_value);

                        if ($cord_arr[0] >= $params[0] && $cord_arr[0] <= $params[1] && $cord_arr[1] >= $params[2] && $cord_arr[1] <= $params[3]) {

                            return $item;
                        }
                    }
                }
            }
        });


        //   echo json_encode($treatment2,JSON_UNESCAPED_UNICODE);

        $record = [];

        foreach ($treatment2 as $val) {

            $prop_ajax_popup_data = array();

            $prop_ajax_popup_data['id'] = $val->id;

            $prop_ajax_popup_data['year'] =  date('Y-m-d', strtotime($val->created_at));

            if (!empty($val->property_type_id)) {

                $prop_ajax_popup_data['type'] =  $val->property_type->name;
            } else {

                $prop_ajax_popup_data['type'] = "";
            }

            if (!empty($val->property_classification_id)) {

                $prop_ajax_popup_data['class'] =  $val->property_classification->name;
            } else {

                $prop_ajax_popup_data['class'] = "";
            }

            if ($val->treatment_detail) {

                foreach ($val->treatment_detail as $val2) {

                    if ($val2->property_attribute_key == "صورةالأقمارالصناعیة") {

                        $prop_ajax_popup_data['location'] =  $val2->property_attribute_value;
                    }

                    if ($val2->property_attribute_key == "الأرض" || $val2->property_attribute_key == "قطعةالأرض" || $val2->property_attribute_key == "الارض") {

                        $widget_array = json_decode($val2->property_attribute_value, true);


                        if (is_array($widget_array)) {

                            $prop_ajax_popup_data['area'] = $widget_array['area'];

                            $prop_ajax_popup_data['price'] = $widget_array['price'];

                            if ($prop_ajax_popup_data['area'] == NULL) {

                                $prop_ajax_popup_data['area'] = "";
                            }

                            if ($prop_ajax_popup_data['price'] == NULL) {

                                $prop_ajax_popup_data['price'] = 1;
                            }
                        } else {

                            $prop_ajax_popup_data['area'] = "";

                            $prop_ajax_popup_data['price'] = "";
                        }
                    }
                }
            }

            $record[] =  $prop_ajax_popup_data;
        }


        echo json_encode($record, JSON_UNESCAPED_UNICODE);
    }



    public static function get_lat_lang_by_id($id)
    {



        $treatment_location = Treatment_detail::select('property_attribute_value')->where('treatment_id', $id)->where('property_attribute_key', 'صورةالأقمارالصناعیة')->first();

        if ($treatment_location) {

            return $treatment_location->property_attribute_value;
        }
    }



    public function updateOrder(Request $request)

    {

        $after_save_images = $images_pdf = "";

        $treatment_detail = Treatment_detail::where('id', $request->treatment_detail_id)->first();

        $treatment = Treatment::where('id', $request->treatment_id)->first();



        $property_attribute_value = $treatment_detail->property_attribute_value;

        $property_attribute_value_arr = explode(',', $property_attribute_value);

        $property_attribute_value_arr_new = array();

        foreach ($property_attribute_value_arr as $key => $val) {

            $id = $key + 1;

            foreach ($request->order as $order) {

                if ($order['id'] == $id) {

                    $property_attribute_value_arr_new[$order['position']] = $val;
                }
            }
        }



        ksort($property_attribute_value_arr_new);

        $after_save_images = implode(',', $property_attribute_value_arr_new);

        $treatment_detail->property_attribute_value = $after_save_images;

        $treatment_detail->save();



        // for pdf images

        $pdf_images = $treatment->pdf_images;

        $pdf_images_arr = explode(',', $pdf_images);

        $pdf_images_arr_new = array();

        foreach ($pdf_images_arr as $key => $val) {

            $id = $key + 1;

            foreach ($request->order as $order) {

                if ($order['id'] == $id) {

                    $pdf_images_arr_new[$order['position']] = $val;
                }
            }
        }



        ksort($pdf_images_arr_new);

        $images_pdf = implode(',', $pdf_images_arr_new);

        $treatment->pdf_images = $images_pdf;

        $treatment->save();



        $after_save_respond['images'] = $after_save_images;

        $after_save_respond['images_pdf']  = $images_pdf;

        $after_save_respond = json_encode($after_save_respond);

        return $after_save_respond;
    }



    public static function tr_std_managements($tr_id, $fldkey)
    {



        $tr_std_managements_result = Treatment_standards_management::where('treatment_id', $tr_id)->where('field_key', $fldkey)->first();
        if ($tr_std_managements_result) {

            return $tr_std_managements_result;
        }
    }

    /*
   * add new criteria to treatment
   * added 26 may 2021
   */
    public function addCriteria(Request $request)
    {
        // property attribute id
        $id = $request->id;
        // json name
        $criteria_name = $request->criteria_name;
        $yallow = array(
            'name' => $criteria_name,
            'taqyeem' => '',
            'bayan1' => '',
            'percentage1' => '',
            'bayan2' => '',
            'percentage2' => '',
            'bayan3' => '',
            'percentage3' => '',
        );

        $attribute = Treatment_detail::findOrFail($id);
        // in case not find
        $attributeValue = $attribute->property_attribute_value;
        // $attribute->property_attribute_key = 'المعايير';
        $value = (array) json_decode($attributeValue);
        if (empty($value)) {
            $value = array();
        }
        array_push($value, $yallow);
        $attribute->property_attribute_value = json_encode($value, JSON_FORCE_OBJECT);
        $attribute->save();
        //echo json_encode($value, JSON_FORCE_OBJECT);

    }
    /*
   * add static (land,other) criteria to treatment
   * added 5 june 2021
   */
    public function addStaticCriteria(Request $request)
    {
        // treatment_id
        $staticarr = "";
        // property attribute id
        $id = $request->id;
        // Proprty type
        $type = $request->type;
        // LAND
        if ($type == 3) {
            $staticarr = array(
                "0" => array(
                    'name' => 'سهولة الوصول',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "1" => array(
                    'name' => 'القرب والبعد لوسط المدينة',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "2" => array(
                    'name' => 'عرض الشارع',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "3" => array(
                    'name' => 'عددالواجهات',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "4" => array(
                    'name' => 'المساحة',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "5" => array(
                    'name' => 'الحيازة',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "6" => array(
                    'name' => 'عمر العقار',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "7" => array(
                    'name' => 'مستوى التشطيب',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "8" => array(
                    'name' => 'الدور او عدد الادوار',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
            );
        } else {
            // Other than land

            $staticarr = array(
                "1" => array(
                    'name' => 'سهولة الوصول',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "2" => array(
                    'name' => 'الدور او عدد الادوار',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "3" => array(
                    'name' => 'المساحة',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),

                "5" => array(
                    'name' => 'الخدمات والمرافق حول الموقع',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "6" => array(
                    'name' => 'عمر العقار',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),
                "7" => array(
                    'name' => 'مستوى التشطيب',
                    'taqyeem' => '',
                    'bayan1' => '',
                    'percentage1' => '',
                    'bayan2' => '',
                    'percentage2' => '',
                    'bayan3' => '',
                    'percentage3' => '',
                ),

            );
        }
        $attribute = Treatment_detail::findOrFail($id);
        // in case not find
        $attributeValue = $attribute->property_attribute_value;
        // $attribute->property_attribute_key = 'المعايير';
        $value = (array) json_decode($attributeValue);
        if (empty($value)) {
            $value = array();
        }
        $value = $staticarr;
        print_r($value);
        $attribute->property_attribute_value = json_encode($value, JSON_FORCE_OBJECT);
        $attribute->save();
        //echo json_encode($value, JSON_FORCE_OBJECT);

    }

    /*
   * save the criteria from ajax
   * added 27 may 2021
   */
    public function saveCriteria(Request $request)
    {
        $id = $request->id;
        $criteria_name = $request->criteria_name;
        $criteria_key = $request->criteria_key;
        $criteria_val = $request->criteria_val;

        $attribute = Treatment_detail::findOrFail($id);
        $attributeValue = $attribute->property_attribute_value;
        $value = (array) json_decode($attributeValue);

        foreach ($value as $criteria) {
            if ($criteria->name == $criteria_name) {
                foreach ($criteria as $key => $val) {
                    if ($key == $criteria_key) {
                        $criteria->$key = $criteria_val;
                    }
                }
            }
        }
        // print_r($value);
        $attribute->property_attribute_value = json_encode($value, JSON_FORCE_OBJECT);
        $attribute->save();
    }

    public function deletecriteria(Request $request)
    {
        $id = $request->id;
        $criteria_name = $request->criteria_name;

        $attribute = Treatment_detail::findOrFail($id);
        $attributeValue = $attribute->property_attribute_value;
        $value = (array) json_decode($attributeValue);
        $x = 0;
        foreach ($value as $criteria) {
            if ($criteria->name == $criteria_name) {
                unset($value[$x]);
                $value = array_values($value);
            }
            $x++;
        }
        // print_r($value);
        $attribute->property_attribute_value = json_encode($value, JSON_FORCE_OBJECT);
        $attribute->save();
    }
}
