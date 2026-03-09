<div class="form-group">
    {{-- Label for the entire section --}}
    <label>{{ $label ?? 'Student Due Dates' }}</label>
    {{-- Wrapper for dynamic rows --}}
    <div id="due-dates-wrapper">
        {{-- Render existing rows in EDIT mode --}}
        @if (!empty($options['existing_due_dates']))
            @foreach ($options['existing_due_dates'] as $key => $row)
                <div class="row mb-2 align-items-center dynamic-row-{{ $key }}">

                    <!-- Users Dropdown -->
                    <div class="col-md-8">
                        <select name="students[{{ $key }}][student_ids][]" class="form-control select2" multiple>
                            @foreach($options['users'] as $student)
                                <option value="{{ $student->id }}"
                                    {{ in_array($student->id, old('students', $row['student_ids'] ?? [])) ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Input -->
                    <div class="col-md-3">
                        <input type="date" name="students[{{ $key }}][due_date]"
                               value="{{ $row['due_date'] }}"
                               class="form-control">
                    </div>

                    <!-- Remove Button -->
                    <div class="col-md-1">
                        <button type="button" class="remove-due-date btn btn-danger btn-sm w-100">
                            &times;
                        </button>
                    </div>

                </div>
            @endforeach
        @endif
    </div>

    {{-- The button to add new rows --}}
    <span class="text-danger"></span>
    <button type="button" id="add-due-date" class="btn btn-primary">
        <i class="fa fa-plus"></i> | Due Date
    </button>
</div>

<script>
    initDueDates(@json($options['users']));

    function initDueDates(users) {
        // Wrap these in function scope so they are local, not global
        const rawUsers = users;

        const studentOptions = Object.keys(rawUsers).map(key => ({
            id: String(rawUsers[key].id),
            text: rawUsers[key].name
        }));

        const $wrapper = $('#due-dates-wrapper');

        function initializeSelect2($element) {
            $element.select2({
                placeholder: 'Select User(s)',
                allowClear: true,
                data: studentOptions,
                width: '100%'
            });
        }

        function createNewRow() {
            const uniqueId = Date.now();
            const newRowHtml = `
            <div class="row mb-2 align-items-center dynamic-row-${uniqueId}">
                <div class="col-md-8">
                    <select name="students[${uniqueId}][student_ids][]" class="form-control select2-students" multiple></select>
                </div>
                <div class="col-md-3">
                    <input type="date" name="students[${uniqueId}][due_date]" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="button" class="remove-due-date btn btn-danger btn-sm w-100">&times;</button>
                </div>
            </div>
        `;
            const $newRow = $(newRowHtml);
            $wrapper.append($newRow);
            initializeSelect2($newRow.find('.select2-students'));
        }

        // Remove previous click handlers before attaching
        $(document).off('click', '#add-due-date').on('click', '#add-due-date', function(e) {
            e.preventDefault();
            createNewRow();
        });

        $(document).off('click', '.remove-due-date').on('click', '.remove-due-date', function() {
            const $row = $(this).closest('[class*="dynamic-row-"]');
            $row.find('select.select2, select.select2-students').each(function() {
                if ($(this).data('select2')) $(this).select2('destroy');
            });
            $row.remove();
        });

        // Initialize Select2 on existing rows
        $wrapper.find('select.select2').each(function() {
            initializeSelect2($(this));
        });
    }

</script>
