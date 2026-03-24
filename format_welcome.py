import sys

def process():
    file_path = r'd:\market\resources\views\welcome.blade.php'
    with open(file_path, 'r', encoding='utf-8') as f:
        lines = f.readlines()

    nav_end = -1
    for i, line in enumerate(lines):
        if '    </nav>' in line:
            nav_end = i
            break

    footer_start = -1
    for i, line in enumerate(lines):
        if '    <!-- Footer -->' in line:
            footer_start = i
            break

    content_lines = lines[nav_end+1:footer_start]
    
    # Strip empty lines from ends
    while content_lines and content_lines[0].strip() == '':
        content_lines.pop(0)
    while content_lines and content_lines[-1].strip() == '':
        content_lines.pop()

    new_lines = ["@extends('layouts.frontend')\n\n", "@section('content')\n"] + content_lines + ["\n@endsection\n"]

    with open(file_path, 'w', encoding='utf-8') as f:
        f.writelines(new_lines)
    print("Welcome updated")

if __name__ == '__main__':
    process()
