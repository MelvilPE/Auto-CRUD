import os

DELETE_FILE_NAME  = "delete.php"
FORM_FILE_NAME    = "form.php"
INDEX_FILE_NAME   = "index.php"
PROCESS_FILE_NAME = "process.php"

CRUD_PRIMARY_KEY = b"CRUD_PRIMARY_KEY"
CRUD_TABLE_NAME  = b"CRUD_TABLE_NAME"
CRUD_ALL_PARAMS  = b"CRUD_ALL_PARAMS"

CRUD_PROCESS_ALL_PARAMS  = b"CRUD_PROCESS_ALL_PARAMS"
CRUD_PROCESS_ALL_END_PARAMS = b"CRUD_PROCESS_ALL_END_PARAMS"

def ProcessFiles(folderName, tableParams):
	"""
	Replaces placeholders : table name & primary key
	Writes the updated lines to the DELETE_FILE_NAME file.
	"""
	def ProcessDelete():
		filePath = os.path.join(folderName, DELETE_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		updateRewriteLines = []
		with open(filePath, 'rb') as file:
			lines = file.readlines()
			for line in lines:
				line = line.replace(CRUD_TABLE_NAME, folderName.encode())
				line = line.replace(CRUD_PRIMARY_KEY, tableParams[0]['name'].encode())
				updateRewriteLines.append(line)

		with open(filePath, 'wb') as file:
			file.writelines(updateRewriteLines)

	def ProcessForm():
		filePath = os.path.join(folderName, FORM_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		updateRewriteLines = []
		with open(filePath, 'rb') as file:
			lines = file.readlines()
			for line in lines:
				line = line.replace(CRUD_TABLE_NAME, folderName.encode())
				line = line.replace(CRUD_PRIMARY_KEY, tableParams[0]['name'].encode())

				if CRUD_ALL_PARAMS in line:
					for param in tableParams:
						eachAppendedLine = line.replace(CRUD_ALL_PARAMS, param['name'].encode())
						updateRewriteLines.append(eachAppendedLine)
					continue

				updateRewriteLines.append(line)

		with open(filePath, 'wb') as file:
			file.writelines(updateRewriteLines)	

	def ProcessIndex():
		filePath = os.path.join(folderName, INDEX_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		updateRewriteLines = []
		with open(filePath, 'rb') as file:
			lines = file.readlines()
			for line in lines:
				line = line.replace(CRUD_TABLE_NAME, folderName.encode())
				line = line.replace(CRUD_PRIMARY_KEY, tableParams[0]['name'].encode())

				if CRUD_ALL_PARAMS in line:
					for param in tableParams:
						eachAppendedLine = line.replace(CRUD_ALL_PARAMS, param['name'].encode())
						updateRewriteLines.append(eachAppendedLine)
					continue

				updateRewriteLines.append(line)

		with open(filePath, 'wb') as file:
			file.writelines(updateRewriteLines)	

	def ProcessProcess():
		filePath = os.path.join(folderName, PROCESS_FILE_NAME)
		if not os.path.exists(filePath):
			return
		
		updateRewriteLines = []
		with open(filePath, 'rb') as file:
			lines = file.readlines()
			for line in lines:
				line = line.replace(CRUD_TABLE_NAME, folderName.encode())
				line = line.replace(CRUD_PRIMARY_KEY, tableParams[0]['name'].encode())

				if CRUD_PROCESS_ALL_PARAMS in line:
					for paramIndex in range(len(tableParams)):
						param = tableParams[paramIndex]
						# Skip the primary key parameter
						if param['name'] == tableParams[0]['name']:
							continue
						
						eachAppendedLine = line.replace(CRUD_PROCESS_ALL_PARAMS, param['name'].encode())
						
						# If it's the last parameter, remove the trailing comma (",")
						if paramIndex == len(tableParams) - 1:
							eachAppendedLine = eachAppendedLine.rstrip().rstrip(b",") + b"\n"

						updateRewriteLines.append(eachAppendedLine)
					continue

				if CRUD_PROCESS_ALL_END_PARAMS in line:
					for param in tableParams:
						# Skip the primary key parameter
						if param['name'] == tableParams[0]['name']:
							continue

						eachAppendedLine = line.replace(CRUD_PROCESS_ALL_END_PARAMS, param['name'].encode())
						updateRewriteLines.append(eachAppendedLine)
					continue

				updateRewriteLines.append(line)

		with open(filePath, 'wb') as file:
			file.writelines(updateRewriteLines)	

	ProcessDelete()
	ProcessForm()
	ProcessIndex()
	ProcessProcess()