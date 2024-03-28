import os

DELETE_FILE_NAME  = "delete.php"
FORM_FILE_NAME    = "form.php"
INDEX_FILE_NAME   = "index.php"
PROCESS_FILE_NAME = "process.php"

def ProcessFiles(folderName):
	def ProcessDelete():
		filePath = os.path.join(folderName, DELETE_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		with open(filePath, 'rb') as file:
			content = file.readlines()
			for each in content:
				print(each)

			print("aaa")

	def ProcessForm():
		filePath = os.path.join(folderName, FORM_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		with open(filePath, 'rb') as file:
			pass

	def ProcessIndex():
		filePath = os.path.join(folderName, INDEX_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		with open(filePath, 'rb') as file:
			pass

	def ProcessProcess():
		filePath = os.path.join(folderName, PROCESS_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		with open(filePath, 'rb') as file:
			pass

	ProcessDelete()
	ProcessForm()
	ProcessIndex()
	ProcessProcess()