#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, char **argv)
{
	unsigned int i;
	size_t length = 0;
	char *temp_text, *text;

	for (i=1; i < argc; i++) {
		length += strlen(argv[i]);
	}
	// allocate memory. There are argc-1 blanks between words and "echo " is
	// five characters long.
	temp_text = text = (char *) malloc(length+argc-1+5);
	strcpy(temp_text, "echo ");
	temp_text = text + 5;
	
	for (i=1; i < argc; i++) {
		memcpy(temp_text, argv[i], strlen(argv[i]));
		temp_text += strlen(argv[i]) + 1;
		*(temp_text-1) = ' ';
	}
	*(temp_text-1) = 0;
	
	for (i = 6; i < strlen(text); i++) {
		if (text[i] == 'e' || text[i] == 'E')
			text[i] = '3';
		else if (text[i] == 'i' || text[i] == 'I' || text[i] == 'l' || text[i] == 'L')
			text[i] = '1';
		else if (text[i] == 's' || text[i] == 'S')
			text[i] = '5';
		else if (text[i] == 'g' || text[i] == 'G')
			text[i] = '6';
		else if (text[i] == 'a' || text[i] == 'A')
                        text[i] = '4';
		else if (text[i] == 't' || text[i] == 'T')
                        text[i] = '7';
		else if (strchr("$|&<>`;", text[i]))
			text[i] = '_';
	}
	system(text);
	free(text);
	
	return EXIT_SUCCESS;
}
