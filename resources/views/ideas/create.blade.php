@extends('layouts.app')

@section('content')
<div class="idea-creation-container">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="idea-card">
                    <div class="idea-header">
                        <div class="header-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h1>Submit Your Idea</h1>
                        <p>Share your innovative solution with government organizations</p>
                    </div>

                    <form action="{{ route('ideas.store') }}" method="POST" enctype="multipart/form-data" id="ideaForm">
                        @csrf

                        <div class="form-sections">
                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-info-circle"></i>
                                    <h3>Basic Information</h3>
                                </div>
                                
                                <!-- Idea Title -->
                                <div class="form-group">
                                    <label for="title">Idea Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" placeholder="Enter a catchy title for your idea"
                                               value="{{ old('title') }}" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('title') {{ $message }} @enderror
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        <select class="form-select @error('category') is-invalid @enderror" 
                                                id="category" name="category" required>
                                            <option value="">Select category</option>
                                            <option value="technology">Technology</option>
                                            <option value="healthcare">Healthcare</option>
                                            <option value="education">Education</option>
                                            <option value="environment">Environment</option>
                                            <option value="infrastructure">Infrastructure</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('category') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Description Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-align-left"></i>
                                    <h3>Idea Details</h3>
                                </div>
                                
                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Describe Your Idea</label>
                                    <div class="description-editor">
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  id="description" name="description" rows="6" 
                                                  placeholder="Share the details of your innovative idea..." required>{{ old('description') }}</textarea>
                                        <div class="editor-toolbar">
                                            <button type="button" class="toolbar-btn" data-format="bold" title="Bold"><i class="fas fa-bold"></i></button>
                                            <button type="button" class="toolbar-btn" data-format="italic" title="Italic"><i class="fas fa-italic"></i></button>
                                            <button type="button" class="toolbar-btn" data-format="list" title="List"><i class="fas fa-list"></i></button>
                                            <button type="button" class="toolbar-btn" data-format="quote" title="Quote"><i class="fas fa-quote-right"></i></button>
                                        </div>
                                    </div>
                                    <div class="char-counter">
                                        <span id="charCount">0</span>/2000 characters
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('description') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Problem & Solution Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-puzzle-piece"></i>
                                    <h3>Problem & Solution</h3>
                                </div>
                                
                                <!-- Problem Statement -->
                                <div class="form-group">
                                    <label for="problem">Problem Statement</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                                        <textarea class="form-control @error('problem') is-invalid @enderror" 
                                                  id="problem" name="problem" rows="3" 
                                                  placeholder="What problem does your idea solve?" required>{{ old('problem') }}</textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('problem') {{ $message }} @enderror
                                    </div>
                                </div>

                                <!-- Solution Benefits -->
                                <div class="form-group">
                                    <label>Key Benefits</label>
                                    <div id="benefitsList">
                                        <div class="benefit-item">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                                <input type="text" class="form-control" name="benefits[]" 
                                                       placeholder="Enter a key benefit">
                                                <button type="button" class="btn btn-outline-danger remove-benefit" style="display: none;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addBenefit">
                                        <i class="fas fa-plus me-1"></i>Add Benefit
                                    </button>
                                </div>
                            </div>

                            <!-- Implementation Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-cogs"></i>
                                    <h3>Implementation</h3>
                                </div>
                                
                                <!-- Required Resources -->
                                <div class="form-group">
                                    <label for="resources">Required Resources</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                        <textarea class="form-control @error('resources') is-invalid @enderror" 
                                                  id="resources" name="resources" rows="3" 
                                                  placeholder="What resources would you need to implement this idea?" required>{{ old('resources') }}</textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('resources') {{ $message }} @enderror
                                    </div>
                                </div>

                                <!-- Timeline -->
                                <div class="form-group">
                                    <label for="timeline">Implementation Timeline</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <select class="form-select @error('timeline') is-invalid @enderror" 
                                                id="timeline" name="timeline" required>
                                            <option value="">Select timeline</option>
                                            <option value="0-3">0-3 months</option>
                                            <option value="3-6">3-6 months</option>
                                            <option value="6-12">6-12 months</option>
                                            <option value="12+">More than 12 months</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('timeline') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Attachments Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <i class="fas fa-paperclip"></i>
                                    <h3>Supporting Documents</h3>
                                </div>
                                
                                <!-- File Upload -->
                                <div class="form-group">
                                    <label for="documents">Upload Documents</label>
                                    <div class="upload-zone" id="dropZone">
                                        <input type="file" id="documents" name="documents[]" multiple class="file-input" accept=".pdf,.doc,.docx,.ppt,.pptx">
                                        <div class="upload-message">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Drag and drop files here or click to browse</p>
                                            <span class="upload-hint">Supported formats: PDF, DOC, DOCX, PPT, PPTX (Max 10MB)</span>
                                        </div>
                                    </div>
                                    <div id="fileList" class="mt-2"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center submit-section">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Submit Idea
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

.idea-creation-container {
    background: linear-gradient(135deg, var(--background-dark) 0%, #FFFFFF 100%);
    min-height: 100vh;
    padding: 2rem 0;
    color: var(--text-primary);
}

.idea-card {
    background: var(--card-bg);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(74, 144, 226, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    border: 1px solid var(--border-color);
}

.idea-card:hover {
    transform: translateY(-5px);
}

.idea-header {
    background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
    color: white;
    padding: 3rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.idea-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.3;
}

.header-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: rgba(255, 255, 255, 0.9);
}

.idea-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.idea-header p {
    font-size: 1.1rem;
    opacity: 0.9;
    position: relative;
    z-index: 1;
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
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 10;
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

.benefit-item {
    margin-bottom: 1rem;
}

.upload-zone {
    border: 2px dashed var(--border-color);
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.upload-zone:hover {
    border-color: var(--primary-color);
    background-color: rgba(74, 144, 226, 0.02);
}

.upload-zone .file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.upload-message {
    color: var(--text-secondary);
}

.upload-message i {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.upload-hint {
    display: block;
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
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

@media (max-width: 768px) {
    .idea-card {
        margin: 1rem;
    }
    
    .form-sections {
        padding: 1rem;
    }
    
    .form-section {
        padding: 1rem;
    }
    
    .idea-header {
        padding: 2rem 1rem;
    }
    
    .idea-header h1 {
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
        
        if (remaining > 2000) {
            this.value = this.value.substring(0, 2000);
            charCount.textContent = 2000;
        }
    });

    // Dynamic benefits
    const benefitsList = document.getElementById('benefitsList');
    const addBenefitBtn = document.getElementById('addBenefit');
    
    addBenefitBtn.addEventListener('click', function() {
        const newBenefit = document.createElement('div');
        newBenefit.className = 'benefit-item';
        newBenefit.innerHTML = `
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                <input type="text" class="form-control" name="benefits[]" placeholder="Enter a key benefit">
                <button type="button" class="btn btn-outline-danger remove-benefit">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        benefitsList.appendChild(newBenefit);
        
        const removeButtons = benefitsList.querySelectorAll('.remove-benefit');
        removeButtons.forEach(button => {
            button.style.display = removeButtons.length > 1 ? 'block' : 'none';
        });
    });

    benefitsList.addEventListener('click', function(e) {
        if (e.target.closest('.remove-benefit')) {
            e.target.closest('.benefit-item').remove();
            
            const removeButtons = benefitsList.querySelectorAll('.remove-benefit');
            if (removeButtons.length === 1) {
                removeButtons[0].style.display = 'none';
            }
        }
    });

    // File upload handling
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('documents');
    const fileList = document.getElementById('fileList');

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = var(--primary-color);
        dropZone.style.backgroundColor = 'rgba(74, 144, 226, 0.05)';
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = var(--border-color);
        dropZone.style.backgroundColor = 'transparent';
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = var(--border-color);
        dropZone.style.backgroundColor = 'transparent';
        
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (file.size > 10 * 1024 * 1024) {
                alert('File size should not exceed 10MB');
                return;
            }

            const fileItem = document.createElement('div');
            fileItem.className = 'alert alert-info alert-dismissible fade show';
            fileItem.innerHTML = `
                <i class="fas fa-file me-2"></i>
                ${file.name}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            fileList.appendChild(fileItem);
        });
    }

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
                    selectedText = `\n- ${selectedText}`;
                    break;
                case 'quote':
                    selectedText = `> ${selectedText}`;
                    break;
            }
            
            textarea.value = text.substring(0, start) + selectedText + text.substring(end);
            textarea.focus();
        });
    });

    // Form validation
    const form = document.getElementById('ideaForm');
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>
@endsection
