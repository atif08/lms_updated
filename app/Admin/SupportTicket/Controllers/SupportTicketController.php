<?php

namespace App\Admin\SupportTicket\Controllers;

use App\Admin\DataTables\SupportTicketDataTable;
use App\Admin\Forms\Courses\SupportTicketForm;
use App\Http\Controllers\BaseController;
use App\Models\SupportTicket;
use App\Notifications\SupportTicketUpdatedNotification;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class SupportTicketController extends BaseController
{
    public function index(Course $course, Request $request)
    {
        $data_table = new SupportTicketDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.support-tickets.index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $this->_getForm($formBuilder, null);

        return $this->renderView('admin.support-tickets.form', compact('form'));
    }

    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {

        $form = $this->_getForm($formBuilder, null);

        $form->redirectIfNotValid();

        $supportTicket = SupportTicket::create($form->getFieldValues() + ['created_by' => $this->user->id]);

        if ($request->has('media')) {
            $supportTicket->addFromMediaLibraryRequest($request->media)->toMediaCollection(MediaCollectionEnum::FILE());
        }

        // Send notification to admin
        //        $admin = User::find(1);
        //        Notification::send($admin, new SupportTicketCreatedNotification($supportTicket));

        $emails = ['atifzaman08@gmail.com', 'career.advisor2@paiu.ae']; // Add your email addresses here
        foreach ($emails as $email) {
            Mail::to($email)->send(new \App\Mail\SupportTicketCreated($supportTicket));
        }

        FlashMessage::success('Support Ticket created successfully !');

        return to_route('support-tickets.index');
    }

    public function edit(SupportTicket $supportTicket, FormBuilder $formBuilder)
    {

        $form = $this->_getForm($formBuilder, $supportTicket);

        return $this->renderView('admin.support-tickets.form', compact('form'));

    }

    public function update(SupportTicket $supportTicket, FormBuilder $formBuilder, Request $request): RedirectResponse
    {

        $form = $this->_getForm($formBuilder, $supportTicket);

        $form->redirectIfNotValid();

        $supportTicket->update($form->getFieldValues());

        if ($request->has('media')) {
            $supportTicket->syncFromMediaLibraryRequest($request->media)->toMediaCollection(MediaCollectionEnum::FILE());
        }

        $admin = User::find(1);

        Notification::send($admin, new SupportTicketUpdatedNotification($supportTicket));

        FlashMessage::success('Support ticket updated successfully !');

        return to_route('support-tickets.index');
    }

    public function destroy(SupportTicket $supportTicket): JsonResponse
    {
        $supportTicket->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $supportTicket]);
    }

    private function _getForm(FormBuilder $form_builder, ?SupportTicket $supportTicket): Form
    {
        return $form_builder->create(SupportTicketForm::class, [
            'method' => $supportTicket ? 'PUT' : 'POST',
            'url' => $supportTicket ? route('support-tickets.update', $supportTicket->id) : route('support-tickets.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $supportTicket,
            'class' => get_class($this),
        ]);
    }
}
