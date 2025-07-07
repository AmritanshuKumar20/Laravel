<!-- resources/views/schemes/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="scheme-creation-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="scheme-card">
                    <div class="scheme-header">
                        <div class="header-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h1>Post New Scheme</h1>
                        <p>Share your government initiative with entrepreneurs</p>
                    </div>

                    <form action="{{ route('schemes.store') }}" method="POST" enctype="multipart/form-data" id="schemeForm">
                        @csrf
                        
                        <div class="form-sections">
                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-info-circle"></i>
                                    <h3>Basic Information</h3>
                                </div>
                                
                                <!-- Scheme Title -->
                                <div class="form-group">
                                    <label for="title">Scheme Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" placeholder="Enter the scheme title"
                                               value="{{ old('title') }}" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('title') {{ $message }} @enderror
                                    </div>
                                </div>

                                <!-- Department -->
                                <div class="form-group">
                                    <label for="department">Government Department</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        <select class="form-select @error('department') is-invalid @enderror" 
                                                id="department" name="department" required>
                                            <option value="">Select department</option>
                                            <option value="ministry_of_technology">Ministry of Technology</option>
                                            <option value="ministry_of_health">Ministry of Health</option>
                                            <option value="ministry_of_education">Ministry of Education</option>
                                            <option value="ministry_of_environment">Ministry of Environment</option>
                                            <option value="ministry_of_infrastructure">Ministry of Infrastructure</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('department') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Description Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-align-left"></i>
                                    <h3>Scheme Details</h3>
                                </div>
                                
                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Scheme Description</label>
                                    <div class="description-editor">
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="4" 
                                                  placeholder="Describe the scheme in detail..." required>{{ old('description') }}</textarea>
                                        <div class="editor-toolbar">
                                            <button type="button" class="toolbar-btn" data-format="bold"><i class="fas fa-bold"></i></button>
                                            <button type="button" class="toolbar-btn" data-format="italic"><i class="fas fa-italic"></i></button>
                                            <button type="button" class="toolbar-btn" data-format="list"><i class="fas fa-list"></i></button>
                                        </div>
                                    </div>
                                    <div class="char-counter">
                                        <span id="charCount">0</span>/1000 characters
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('description') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Objectives Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-bullseye"></i>
                                    <h3>Objectives & Requirements</h3>
                                </div>
                                
                                <!-- Objectives -->
                                <div class="form-group">
                                    <label>Objectives</label>
                                    <div id="objectivesList">
                                        <div class="objective-item">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                                <input type="text" class="form-control" name="objectives[]" 
                                                       placeholder="Enter an objective">
                                                <button type="button" class="btn btn-outline-danger remove-objective" style="display: none;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addObjective">
                                        <i class="fas fa-plus me-1"></i>Add Objective
                                    </button>
                                </div>
                            </div>

                            <!-- Funding & Timeline Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <h3>Funding & Timeline</h3>
                                </div>
                                
                                <!-- Funding -->
                                <div class="form-group">
                                    <label for="funding">Funding Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        <input type="text" class="form-control @error('funding') is-invalid @enderror" 
                                               id="funding" name="funding" placeholder="Enter funding amount"
                                               value="{{ old('funding') }}" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('funding') {{ $message }} @enderror
                                    </div>
                                </div>

                                <!-- Deadline -->
                                <div class="form-group">
                                    <label for="deadline">Application Deadline</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <input type="date" class="form-control @error('deadline') is-invalid @enderror" 
                                               id="deadline" name="deadline" 
                                               value="{{ old('deadline') }}" required>
                                    </div>
                                    <div class="deadline-info"></div>
                                    <div class="invalid-feedback">
                                        @error('deadline') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-envelope"></i>
                                    <h3>Contact Information</h3>
                                </div>
                                
                                <!-- Contact -->
                                <div class="form-group">
                                    <label for="contact">Contact Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('contact') is-invalid @enderror" 
                                               id="contact" name="contact" placeholder="Enter contact email"
                                               value="{{ old('contact') }}" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('contact') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center submit-section">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Post Scheme
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #4A90E2;
    --primary-dark: #357ABD;
    --secondary-color: #5D9CEC;
    --background-dark: #F5F9FF;
    --card-bg: #FFFFFF;
    --text-primary: #2C3E50;
    --text-secondary: #34495E;
    --border-color: #E0E6E6;
    --input-bg: #FFFFFF;
    --input-border: #E0E6E6;
    --input-focus: #4A90E2;
    --error-color: #E57373;
    --success-color: #81C784;
    --gradient-start: #4A90E2;
    --gradient-end: #5D9CEC;
}

.scheme-creation-container {
    background: linear-gradient(135deg, var(--background-dark) 0%, #FFFFFF 100%);
    min-height: 100vh;
    padding: 2rem 0;
    color: var(--text-primary);
}

.scheme-card {
    background: var(--card-bg);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(74, 144, 226, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    border: 1px solid var(--border-color);
}

.scheme-card:hover {
    transform: translateY(-5px);
}

.scheme-header {
    background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
    color: white;
    padding: 3rem 2rem;
    text-align: center;
    position: relative;
}

.header-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: rgba(255, 255, 255, 0.9);
}

.scheme-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.scheme-header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.form-sections {
    padding: 2rem;
}

.form-section {
    background: var(--card-bg);
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
    border: 1px solid var(--border-color);
}

.form-section:hover {
    background: var(--card-bg);
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.1);
    transform: translateY(-2px);
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}

.section-header i {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin-right: 1rem;
}

.section-header h3 {
    margin: 0;
    color: var(--text-primary);
    font-weight: 600;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-group label {
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    display: block;
}

.input-group {
    position: relative;
}

.input-group-text {
    background: var(--gradient-start);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
}

.form-control, .form-select {
    background-color: var(--input-bg);
    border: 1px solid var(--input-border);
    color: var(--text-primary);
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    background-color: var(--input-bg);
    border-color: var(--input-focus);
    box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.15);
    color: var(--text-primary);
}

.form-control::placeholder {
    color: var(--text-secondary);
}

.description-editor {
    position: relative;
}

.editor-toolbar {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background: var(--card-bg);
    border-radius: 4px;
    padding: 0.25rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.toolbar-btn {
    background: none;
    border: none;
    padding: 0.25rem 0.5rem;
    color: var(--text-primary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.toolbar-btn:hover {
    color: var(--primary-color);
}

.char-counter {
    text-align: right;
    color: var(--text-secondary);
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.objective-item {
    margin-bottom: 1rem;
}

.deadline-info {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.submit-section {
    padding: 2rem;
    background: rgba(255, 255, 255, 0.02);
    border-top: 1px solid var(--border-color);
}

.btn-primary {
    background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
    border: none;
    padding: 1rem 2.5rem;
    font-weight: 600;
    border-radius: 30px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.2);
}

.btn-outline-primary {
    color: var(--gradient-start);
    border-color: var(--gradient-start);
}

.btn-outline-primary:hover {
    background: var(--gradient-start);
    color: white;
}

.btn-outline-danger {
    color: var(--error-color);
    border-color: var(--error-color);
}

.btn-outline-danger:hover {
    background: var(--error-color);
    color: var(--text-primary);
}

@media (max-width: 768px) {
    .scheme-card {
        margin: 1rem;
    }
    
    .form-sections {
        padding: 1rem;
    }
    
    .form-section {
        padding: 1rem;
    }
    
    .scheme-header {
        padding: 2rem 1rem;
    }
    
    .scheme-header h1 {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for description
    const description = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    
    description.addEventListener('input', function() {
        const remaining = this.value.length;
        charCount.textContent = remaining;
        
        if (remaining > 1000) {
            this.value = this.value.substring(0, 1000);
            charCount.textContent = 1000;
        }
    });

    // Dynamic objectives
    const objectivesList = document.getElementById('objectivesList');
    const addObjectiveBtn = document.getElementById('addObjective');
    
    addObjectiveBtn.addEventListener('click', function() {
        const newObjective = document.createElement('div');
        newObjective.className = 'objective-item';
        newObjective.innerHTML = `
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                <input type="text" class="form-control" name="objectives[]" placeholder="Enter an objective">
                <button type="button" class="btn btn-outline-danger remove-objective">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        objectivesList.appendChild(newObjective);
        
        const removeButtons = objectivesList.querySelectorAll('.remove-objective');
        removeButtons.forEach(button => {
            button.style.display = removeButtons.length > 1 ? 'block' : 'none';
        });
    });

    objectivesList.addEventListener('click', function(e) {
        if (e.target.closest('.remove-objective')) {
            e.target.closest('.objective-item').remove();
            
            const removeButtons = objectivesList.querySelectorAll('.remove-objective');
            if (removeButtons.length === 1) {
                removeButtons[0].style.display = 'none';
            }
        }
    });

    // Funding input formatting
    const fundingInput = document.getElementById('funding');
    
    fundingInput.addEventListener('input', function() {
        let value = this.value.replace(/[^0-9]/g, '');
        if (value) {
            value = parseInt(value);
            this.value = new Intl.NumberFormat('en-US').format(value);
        }
    });

    // Deadline validation and info
    const deadline = document.getElementById('deadline');
    const deadlineInfo = document.querySelector('.deadline-info');
    const today = new Date().toISOString().split('T')[0];
    deadline.min = today;

    deadline.addEventListener('change', function() {
        const deadlineDate = new Date(this.value);
        const today = new Date();
        const diffTime = deadlineDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays > 0) {
            deadlineInfo.textContent = `${diffDays} days remaining`;
            deadlineInfo.style.color = 'var(--success-color)';
        } else {
            deadlineInfo.textContent = 'Deadline has passed';
            deadlineInfo.style.color = 'var(--error-color)';
        }
    });

    // Form validation
    const form = document.getElementById('schemeForm');
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });

    // Rich text editor functionality
    const toolbarButtons = document.querySelectorAll('.toolbar-btn');
    toolbarButtons.forEach(button => {
        button.addEventListener('click', function() {
            const format = this.dataset.format;
            const textarea = document.getElementById('description');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const text = textarea.value;
            let selectedText = text.substring(start, end);
            
            switch(format) {
                case 'bold':
                    selectedText = `**${selectedText}**`;
                    break;
                case 'italic':
                    selectedText = `*${selectedText}*`;
                    break;
                case 'list':
                    selectedText = `- ${selectedText}`;
                    break;
            }
            
            textarea.value = text.substring(0, start) + selectedText + text.substring(end);
            textarea.focus();
        });
    });
});
</script>
@endsection
