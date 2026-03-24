import sys

def process():
    file_path = r'd:\market\resources\views\layouts\frontend.blade.php'
    with open(file_path, 'r', encoding='utf-8') as f:
        lines = f.readlines()

    # Find navigation end
    nav_end = -1
    for i, line in enumerate(lines):
        if '    </nav>' in line:
            nav_end = i
            break

    # Find footer start
    footer_start = -1
    for i, line in enumerate(lines):
        if '    <!-- Footer -->' in line:
            footer_start = i
            break

    new_lines = lines[:nav_end+1] + ['\n    @yield("content")\n\n'] + lines[footer_start:]
    
    for i, line in enumerate(new_lines):
        if '<nav class="navbar">' in line:
            new_lines[i] = line.replace('<nav class="navbar">', '<nav class="navbar @yield(\'navbar-class\')">')
            break

    with open(file_path, 'w', encoding='utf-8') as f:
        f.writelines(new_lines)
    print("Done")

if __name__ == '__main__':
    process()
